<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Doc extends CI_Controller {

	private $fileType = array();
	/**
	 * Index Page for this controller.
	 */

	function __construct(){
		parent::__construct();
		//$this->output->set_content_type('application/json');
		$this->load->database();
		$this->load->library('facebook');
		$this->load->library('pdf');
		$this->load->model('user_model');
	}

	public function tt(){
		$this->load->library("zebra_img");
		var_dump($this->zebra_img);
	}

	public function upload(){
		// Make sure file is not cached (as it happens for example on iOS devices)
		if(!headers_sent()){
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");
		}
		// 5 minutes execution time
		@set_time_limit(5 * 60);
		$uploadTmpPath = $this->config->item('upload_tmp_path');
		$maxFileAge = $this->config->item('upload_tmp_age');
		log_message('debug', "Path : {$uploadTmpPath}");

		if(!($id = $this->input->post('id'))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID must be specific"
			));
		}else if(!($token = $this->input->post('token')) OR !is_string($token) OR empty($token)){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload",
				"timestamp"	=> time(),
				"reason"	=> "Token must be specific"
			));
		}else if(strlen($token) > 120){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload",
				"timestamp"	=> time(),
				"reason"	=> "Token too long"
			));
		}else if(!($fbId = $this->user_model->getFbId($token)) OR $fbId != $id){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID incorrect"
			));
		}else if(!($registerId = $this->user_model->getRegisterId($id))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID #{$fbId} isn't registered"
			));
		}else{
			do{
				$fileName = uniqid("tmp_");
				$queryResult = $this->db->select('id')->from('registration_upload')->where('location', $fileName)->get();
			}while($queryResult && $queryResult->num_rows() > 0);
			log_message('debug', "File : {$fileName}");
			$filePath = "{$uploadTmpPath}{$fileName}";

			// Chunking might be enabled
			$chunk = intval($this->input->post('chunk'));
			$chunks = intval($this->input->post('chunks'));

			//clear old temp part
			$dir = opendir($uploadTmpPath);
			while (($file = readdir($dir)) !== false) {
				$tmpfilePath = $uploadTmpPath . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$filePath}.part") {
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);

			// Open temp file
			if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
				echo json_encode(array(
					'jsonrpc'	=> "2.0",
					"status"	=> "error",
					"doc"		=> "upload",
					"timestamp"	=> time(),
					"reason"	=> "Failed to open output stream.",
					'error'		=> array(
						'code'	=> 102,
						'message' => "Failed to open output stream."
						),
					"id"		=> 'id'
				));
			}else if(empty($_FILES)) {
				echo json_encode(array(
					'jsonrpc'	=> "2.0",
					"status"	=> "error",
					"doc"		=> "upload",
					"timestamp"	=> time(),
					"reason"	=> "Failed to open output stream.",
					'error'		=> array(
						'code'	=> 101,
						'message' => "Failed to open output stream."
						),
					"id"		=> 'id'
				));
			}else{
				if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
					echo json_encode(array(
						'jsonrpc'	=> "2.0",
						"status"	=> "error",
						"doc"		=> "upload",
						"timestamp"	=> time(),
						"reason"	=> "Failed to move uploaded file.",
						'error'		=> array(
							'code'	=> 103,
							'message' => "Failed to move uploaded file."
							),
						"id"		=> 'id'
					));
				}else if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) { // Read binary input stream and append it to temp file
					echo json_encode(array(
						'jsonrpc'	=> "2.0",
						"status"	=> "error",
						"doc"		=> "upload",
						"timestamp"	=> time(),
						"reason"	=> "Failed to open output stream.",
						'error'		=> array(
							'code'	=> 101,
							'message' => "Failed to open output stream."
							),
						"id"		=> 'id'
					));
				}else{
					log_message('debug', "File Readed : {$_FILES["file"]["tmp_name"]}");
					while ($buff = fread($in, 4096)) {
						fwrite($out, $buff);
					}
					@fclose($out);
					@fclose($in);
					// Check if file has been uploaded
					if (!$chunks || $chunk == $chunks - 1) {
						// Strip the temp .part suffix off 
						rename("{$filePath}.part", $filePath);					
						//verifying
						$finfo = new finfo(FILEINFO_MIME);
						$allowedImage = $this->config->item('upload_image_allow');
						
						log_message('debug', "File: {$filePath} => type =>".$finfo->file($filePath));
						// application/octet-stream

						if(($imgInfo = getimagesize($filePath)) && in_array($imgInfo[2], $allowedImage)){ //it's image
							$fileExtension = image_type_to_extension($imgInfo[2]);
						}else if(
							($currFileExtension = $finfo->file($filePath)) && 
							(
								strpos($currFileExtension, 'application/pdf') === 0 OR 
								strpos($currFileExtension, 'application/octet-stream') === 0
							)
						){ // it maybe a pdf
							try {
								if(
									$this->pdf->setSourceFile($filePath) > 0/* && 
									$this->pdf->useTemplate(
										$this->pdf->importPage(1)
									)*/
								){ //it's real PDF file
									$fileExtension = '.pdf';	
								}else{
									echo json_encode(array(
										'jsonrpc'	=> "2.0",
										"status"	=> "error",
										"doc"		=> "upload",
										"timestamp"	=> time(),
										"reason"	=> "Unusable PDF file",
										'error'		=> array(
											'code'	=> 104,
											'message' => "Unusable PDF file"
											),
										"id"		=> 'id'
									));
									@unlink($filePath);
								}		
							} catch (Exception $e) {
								echo json_encode(array(
									'jsonrpc'	=> "2.0",
									"status"	=> "error",
									"doc"		=> "upload",
									"timestamp"	=> time(),
									"reason"	=> "Unreadable PDF file",
									'error'		=> array(
										'code'	=> 104,
										'message' => "Unreadable PDF file"
										),
									"id"		=> 'id'
								));
								@unlink($filePath);
								return;
							}
						}else{
							echo json_encode(array(
								'jsonrpc'	=> "2.0",
								"status"	=> "error",
								"doc"		=> "upload",
								"timestamp"	=> time(),
								"reason"	=> "Unsupported filetype",
								'error'		=> array(
									'code'	=> 105,
									'message' => "Unsupported filetype"
									),
								"id"		=> 'id'
							));
							@unlink($filePath);
							return;
						}

						if(isset($fileExtension)){
							log_message('debug', "fileExtension : {$fileName}{$fileExtension}");
							$this->db->insert('registration_upload', array(
								'userid'	=> $registerId,
								'file'		=> 0,
								'method'	=> 1,
								'location'	=> $fileName,
								'confirmed'	=> 0
								));
							if($this->db->affected_rows() > 0){
								echo json_encode(array(
									'jsonrpc'	=> "2.0",
									"status"	=> "success",
									"doc"		=> "upload",
									"timestamp"	=> time(),
									"result"	=> array('file_code'	=> md5($fileName.$registerId)),
									"id"		=> $this->db->insert_id()
								));
							}else{
								echo json_encode(array(
									'jsonrpc'	=> "2.0",
									"status"	=> "error",
									"doc"		=> "upload",
									"timestamp"	=> time(),
									"reason"	=> "Unable to register file",
									'error'		=> array(
										'code'	=> 106,
										'message' => "Unable to register file"
										),
									"id"		=> 'id'
								));
							}
						}
					}else{
						// Return Success JSON-RPC response
						echo '{"jsonrpc" : "2.0", "result" : null, "id" : "id"}';
					}

				}
			}
		}
	}

	public  function confirm(){
		log_message('debug', 'Confirm => '.print_r($this->input->post(), true));
		if(!($id = $this->input->post('id'))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID must be specific"
			));
		}else if(!($token = $this->input->post('token')) OR !is_string($token) OR empty($token)){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "Token must be specific"
			));
		}else if(strlen($token) > 120){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "Token too long"
			));
		}else if(!($fbId = $this->user_model->getFbId($token)) OR $fbId != $id){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID incorrect"
			));
		}else if(!($userId = $this->user_model->getRegisterId($id))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "Facebook ID #{$fbId} isn't registered"
			));
		}else if(!($fileId = (int) $this->input->post('file_id'))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "File ID must be specific"
			));
		}else if(!($fileType = (int) $this->input->post('file_type'))){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "File ID must be specific"
			));
		}else if(!($fileTypesList = $this->_getFileType()) OR !isset($fileTypesList[$fileType])){
			echo json_encode(array(
				"status"	=> "fail",
				"doc"		=> "upload_confirm",
				"timestamp"	=> time(),
				"reason"	=> "File ID doesn't exist"
			));
		}else{
			$queryResult = $this->db->select('userid, location')->where('id', $fileId)->get('registration_upload', 1, 0);
			if($queryResult->num_rows() <= 0){
				log_message('debug', 'Error While Query : '. ($this->db->last_query()));
				echo json_encode(array(
					"status"	=> "fail",
					"doc"		=> "upload_confirm",
					"timestamp"	=> time(),
					"reason"	=> "File not found"
				));
			}else{
				$row = $queryResult->row_array();
				$uploadTmpPath = $this->config->item('upload_tmp_path');
				$uploadRealPath = $this->config->item('upload_real_path');
				$fileTmpPath = "{$uploadTmpPath}{$row['location']}";
				if($row['userid'] != $userId){
					echo json_encode(array(
						"status"	=> "fail",
						"doc"		=> "upload_confirm",
						"timestamp"	=> time(),
						"reason"	=> "User doesn't match"
					));
				}else if(is_file($fileTmpPath) && is_readable($fileTmpPath)){
					//verifying
					$finfo = new finfo(FILEINFO_MIME);
					$allowedImage = $this->config->item('upload_image_allow');

					if(($imgInfo = getimagesize($fileTmpPath)) && in_array($imgInfo[2], $allowedImage)){ //it's image
						$fileExtension = image_type_to_extension($imgInfo[2]);
						$previewHandler = 'zebra';
					}else if(
						($currFileExtension = $finfo->file($fileTmpPath)) && 
						(
							strpos($currFileExtension, 'application/pdf') === 0 OR 
							strpos($currFileExtension, 'application/octet-stream') === 0
						)
					){ // it maybe a pdf
						try{
							if(
								$this->pdf->setSourceFile($fileTmpPath) > 0 && 
								$this->pdf->AddPage()?1:true &&
								$this->pdf->useTemplate(
									$this->pdf->importPage(1)
								)
							){ //it's real PDF file
								$fileExtension = '.pdf';
								$previewHandler = 'fpdi';
							}else{
								echo json_encode(array(
									"status"	=> "error",
									"doc"		=> "upload_confirm",
									"timestamp"	=> time(),
									"reason"	=> "Unusable PDF file"
								));
								@unlink($fileTmpPath);
							}		
						}catch(Exception $e) {
							echo json_encode(array(
								"status"	=> "error",
								"doc"		=> "upload_confirm",
								"timestamp"	=> time(),
								"reason"	=> "Unreadable PDF file"
							));
							@unlink($fileTmpPath);
						}
					}
					if(isset($previewHandler)){
						$isMoved = false;
						$realFileName = "{$uploadRealPath}{$row['location']}{$fileExtension}";
						$previewFileName = "{$uploadRealPath}{$row['location']}_preview{$fileExtension}";
						$realSize = $this->config->item('upload_real_size');
						$previewSize = $this->config->item('upload_preview_size');						
						if($previewHandler === 'zebra'){
							$this->load->library("zebra_img");
							$this->zebra_img->source_path = $fileTmpPath;
							$this->zebra_img->target_path = $realFileName;
							$this->zebra_img->sharpen_images = true;
							if($this->zebra_img->resize($realSize[0], $realSize[1], ZEBRA_IMAGE_CROP_CENTER)){
								$this->zebra_img->source_path = $realFileName;
								$this->zebra_img->target_path = $previewFileName;
								if($this->zebra_img->resize($previewSize[0], $previewSize[1], ZEBRA_IMAGE_CROP_CENTER)){
									$isMoved = true;
								}
							}
						}else if($previewHandler === 'fpdi'){
							if(rename($fileTmpPath, $realFileName)){
								try {
									$this->pdf->setSourceFile($realFileName);
									$this->pdf->addPage();
									$this->pdf->useTemplate(
										$this->pdf->importPage(1)
									);
									$this->pdf->AddFont ( 'TH Sarabum New', '', 'THSarabunNew_0.php' );
									$this->pdf->SetFont('TH Sarabum New','',16);
									$this->pdf->SetTextColor(255, 0, 0);
									$this->pdf->SetXY(30, 30);
									$this->pdf->Write(0, 'PDF Preview');
									$this->pdf->Output($previewFileName, 'F');
								}catch(Exception $e) {
									//error
								}

								if(is_file($previewFileName)){
									$isMoved = true;
								}
							}
						}else{
							echo json_encode(array(
								"status"	=> "error",
								"doc"		=> "upload_confirm",
								"timestamp"	=> time(),
								"reason"	=> "Cannot move to real location"
							));
						}

						if($isMoved){
							$this->db->where('id', $fileId)->update('registration_upload', array(
								'file'	=> $fileType,
								'confirmed'	=> time()
								));
							if($this->db->affected_rows() > 0){
								echo json_encode(array(
									"status"	=> "success",
									"doc"		=> "upload_confirm",
									"id"		=> $id,
									"timestamp"	=> time()
								));
								if($previewHandler === 'fpdi'){
									@unlink($fileTmpPath);
								}
							}else{
								echo json_encode(array(
									"status"	=> "error",
									"doc"		=> "upload_confirm",
									"id"		=> $id,
									"timestamp"	=> time(),
									"reason"	=> "Cannot log to database"
								));
							}
						}else{
							echo json_encode(array(
								"status"	=> "error",
								"doc"		=> "upload_confirm",
								"timestamp"	=> time(),
								"reason"	=> "Malformed file"
							));
						}
					}
				}

			}
		}

	}

	private function _getFileType(){
		if(!empty($this->fileType)){
			return $this->fileType;
		}else{
			$queryResult = $this->db->select('id, document_type')->from('registration_document')->get();
			if($queryResult->num_rows() > 0){
				foreach ($queryResult->result_array() as $row) {
					$this->fileType[$row['id']] = $row['document_type'];
				}
				return $this->fileType;
			}
			return array();
		}
	}
}
/* End of file doc.php */
/* Location: ./application/controllers/doc.php */
