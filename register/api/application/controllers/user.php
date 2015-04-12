<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	function __construct(){
		parent::__construct();
		//$this->output->set_content_type('application/json');
		date_default_timezone_set('Asia/Bangkok');
		$this->load->database();
		$this->load->library('facebook');
		$this->load->model('user_model');
		$this->load->driver('cache', array('adapter' => 'file'/*, 'backup' => 'file'*/));
	}

	public function index(){
		if($token = $this->input->post('code')){
			var_dump($this->user_model->getToken($token, 1));
		}
		//var_dump($this->facebook->get_user($this->input->post('code')));
		echo $this->input->ip_address();
		echo realpath(__DIR__.'/../../../../27/assets/img/comcamp_logo.png');
		//echo $this->facebook->login_url();
	}

	public function delete($id, $passKey){

	}

	public function token(){
		if($fbToken = $this->input->post('code')){
			if(!($token = $this->user_model->getToken($fbToken, 1, $reason))){
				echo json_encode(array(
					"status"	=> "fail",
					"FBToken"	=> $fbToken,
					"timestamp"	=> time(),
					"reason"	=> "Fail to request a token : {$reason}"
				));
			}else{
				echo json_encode(array(
					"status"	=> "success",
					"FBToken"	=> $fbToken,
					"timestamp"	=> time(),
					"token"		=> $token
				));
			}
		}else{
			echo json_encode(array(
				"status"	=> "fail",
				"timestamp"	=> time(),
				"reason"	=> "POST of Facebook token must be specific"
			));
		}
	}

	public function checkToken(){
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 1);
			if(isset($result['error'])){
				echo json_encode(array(
					"status"	=> "fail",
					"token"		=> $token,
					"timestamp"	=> time(),
					"reason"	=> $result['error']
				));
			}else{
				echo json_encode(array(
					"status"	=> "success",
					"token"		=> $token,
					"timestamp"	=> time(),
					"token"		=> true
				));
			}
		}else{
			echo json_encode(array(
				"status"	=> "fail",
				"timestamp"	=> time(),
				"reason"	=> "Token must be specific"
			));
		}
	}

	public function lite(){
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, -1);
			if(isset($result['error'])){
				log_message('debug', "Token : ".print_r($result, true));
				echo json_encode(array(
					"status"	=> "fail",
					"token"		=> $token,
					"timestamp"	=> time(),
					"reason"	=> $result['error']
				));
			}else{
				$fbId = $this->user_model->getFbId($token);
				$queryResult = $this->db->select('fname_th, lname_th, gender')->where('fb_id', $fbId)->get('registration_data', 1, 0);
				$userdata = array();
				//log_message('info', "lite: Query => ".($this->db->last_query()));
				if($queryResult->num_rows() > 0){
					$registered = true;
					$row = $queryResult->row_array();
					$userdata = array(
						'id'			=> $fbId,
						"first_name"	=> $row['fname_th'],
						"last_name" 	=> $row['lname_th'],
						"gender"		=> ($row['gender'] > 1)?'female':'male'
					);
				}else{
					$facebookUser = $this->facebook->get_simple($fbId);
					if(!isset($facebookUser['error'])){
						$registered = false;
						$userdata = array(
							'id'			=> $fbId,
							"first_name"	=> $facebookUser['first_name'],
							"last_name" 	=> $facebookUser['last_name'],
							"gender"		=> $facebookUser['gender']
						);
					}else{
						echo json_encode(array(
							"status"	=> "fail",
							"token"		=> $token,
							"timestamp"	=> time(),
							"reason"	=> $facebookUser['error']
						));
					}
				}
				if(isset($registered)){
					echo json_encode(array(
						"status"	=> "success",
						'version'	=> 'lite',
						//"token"		=> $token,
						"fb_id"		=> $fbId,
						"timestamp"	=> time(),
						'logged_in'	=> true,
						"registered"=> $registered,
						'userdata'	=> $userdata
					));
				}
			}
		}else{
			echo json_encode(array(
				"status"	=> "fail",
				"timestamp"	=> time(),
				"reason"	=> "Token must be specific"
			));
		}
	}

	public function full_test(){
		var_dump($this->user_model->getUserData(1));
	}

	public function full($idFromAdmin = 0){
		if($token = $this->input->post('code')){
			$id = 0; 
			$idFromAdmin = (int) $idFromAdmin;
			if($idFromAdmin > 0){
				$result = $this->user_model->checkToken($token, 2);
				if(isset($result['error'])){
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "full",
						"timestamp"	=> time(),
						"reason"	=> $result['error']
					));
					return;
				}else{					
					$id = $idFromAdmin;
					log_message('debug', 'Full Admin '.json_encode($result).' ---- '.$idFromAdmin.' => '.$id);
				}
			}else{
				$result = $this->user_model->checkToken($token, -1);
				if(isset($result['error'])){
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "full",
						"timestamp"	=> time(),
						"reason"	=> $result['error']
					));
					return;
				}else if(isset($result['permision']) && $result['permision'] == 2){
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "full",
						"timestamp"	=> time(),
						"reason"	=> "Search ID undeclared"
					));	
					return;				
				}else if(($id = $this->user_model->getFbId($token)) == false){
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "full",
						"timestamp"	=> time(),
						"reason"	=> "User ID not found"
					));
					return;
				}
			}
			log_message('debug', 'Full    =>  '.$id);
			if($id > 0){
				$userData	= $this->user_model->getUserData($id, !($idFromAdmin > 0));
				if(isset($userData['registered']) && $userData['registered']){
					$userid					= $this->user_model->getRegisterId($id, true);
					$userData['sent_doc']	= array();
					$queryResult = $this->db->query(
						"SELECT 
							`main_table`.`id`, 
							`main_table`.`file`, 
							`main_table`.`method`, 
							`main_table`.`edited`, 
							`main_table`.`result`, 
							`option_upload_fail`.`reason`
						FROM (`registration_upload` main_table)
						LEFT JOIN `registration_upload` criteria_table ON 
							`main_table`.`id`		< `criteria_table`.`id` AND 
							`main_table`.`file`		= `criteria_table`.`file` AND 
							`main_table`.`userid`	= `criteria_table`.`userid`
						LEFT JOIN `option_upload_fail` ON `option_upload_fail`.`id` = `main_table`.`result`
						LEFT JOIN `registration_document` ON `registration_document`.`id` = `main_table`.`file`
						WHERE `main_table`.`userid` =  '{$userid}'
						AND `main_table`.`file` !=  0
					");
						/*->select('
							main_table.id, 
							main_table.file, 
							main_table.method, 
							main_table.edited, 
							main_table.result, 
							option_upload_fail.reason,
						')
						->from('registration_upload main_table')
						->join(
							'registration_upload criteria_table', 
							'main_table.id < criteria_table.id AND 
							main_table.file = criteria_table.file AND 
								main_table.userid = criteria_table.userid
							', 
							'left'
						)
						->join(
							'option_upload_fail', 
							'option_upload_fail.id = registration_upload.result', 
							'left'
						)
						->join(
							'registration_document', 
							'registration_document.id = registration_upload.file'
							//'left'
						)
						->where(
							array(
								'registration_upload.userid'		=> $userid,
								'registration_upload.file != '	=> 0
							)
						)
						->get();*/
						log_message('debug', 'SQL -> '.($this->db->last_query()));

					$docType = $this->_getDocumentType();
					if($queryResult->num_rows() > 0){
						foreach ($queryResult->result_array() as $row) {
							if(isset($docType[$row['file']])){
								$fileType = $docType[$row['file']]['alias'];
								unset($docType[$row['file']]);
							}else{
								$fileType = $row['file'];
							}
							$userData['sent_doc'][$fileType] = array(
								'date'		=> $row['edited'],
								'file_type'	=> $row['file'],
								'file_id'	=> $row['id'],
								'sent_by'	=> ($row['method']==0?'paper':'upload'),
								'status'	=> ($row['result']==0?'checking':($row['result']==1?'pass':'fail')),
								'revision'	=> 1
							);
							if($row['result'] != 0 && $row['result'] != 1){
								$userData['sent_doc'][$fileType]['fail_reason'] = $row['reason'];
							}
						}
					}

					if(!empty($docType)){
						foreach ($docType as $row) {
							$userData['sent_doc'][$row['alias']] = array(
								'date'	=> date("Y-m-d H:i:s"),
								'status'	=> 'not_sent'
							);
						}
					}

					echo json_encode(array(
						"status"	=> "success",
						'version'	=> 'full',
						"timestamp"	=> time(),
						'logged_in'	=> true,
						"registered"=> true,
						'userdata'	=> $userData
					));
				}else{
					$this->lite();
				}
			}
		}else{
			echo json_encode(array(
				"status"	=> "fail",
				"user"		=> "full",
				"timestamp"	=> time(),
				"reason"	=> "Web token must be specific"
			));
		}
	}

	public function getpdf($idFromAdmin = 0){
		if($token = $this->input->post('code')){
			$id = 0;
			$idFromAdmin = (int) $idFromAdmin;
			if($idFromAdmin > 0){
				$result = $this->user_model->checkToken($token, 2);
				if(isset($result['error'])){
					show_error("Error when try generating PDF : {$result['error']}", 200);
				}else{
					$id = $idFromAdmin;
				}
			}else{
				$result = $this->user_model->checkToken($token, -1);
				if(isset($result['error'])){
					show_error("Error when try generating PDF : {$result['error']}", 200);
				}else if(($id = $this->user_model->getRegisterId($this->user_model->getFbId($token), true)) == false){
					log_message('debug', 'getpdf: error => query :'.($this->db->last_query()));
					show_error("Error while generating PDF : ID Not found.");
				}
			}
		

			if($id > 0){
				$this->config->load('pdf');
				$this->load->library('pdf');
				$this->load->helper('facebook_time');
				$printData = $this->config->item('printData');
				$pdfPath = $this->config->item('pdf_path');
				$pdfTemplate = $this->config->item('pdf_template');
				$pdfVersion = filemtime($pdfTemplate);
				$pdfFileName = "comcamp27_v{$pdfVersion}_id{$id}.pdf";
				$pdfFilePath = "{$pdfPath}{$pdfFileName}";
				if(is_file($pdfFilePath) && is_readable($pdfFilePath)) {
					$this->_headerPDF($pdfFileName);
					readfile($pdfFilePath);
				}else if(is_writable($pdfPath)){
					$userData = $this->user_model->getUserData($id);
					if(isset($userData['error'])){
						show_error("Error when try getting userdata : {$userData['error']}", 200);
					}else if($userData['registered'] == false){
						show_error("Error while generating PDF : This user isn't registered.");
					}else{
						include __DIR__.'/registerData.inc';
						//log_message('debug', 'Register => '.print_r($registerData, true));
						//log_message('debug', 'userData => '.print_r($userData, true));
						include __DIR__.'/pdf_gen.inc';
						if(isset($pdfResult) && is_string($pdfResult) && file_put_contents($pdfFilePath, $pdfResult)){
							log_message('debug', filesize($pdfFilePath));
							$this->_headerPDF($pdfFileName);
							echo $pdfResult;
						}else{
							show_error('Can\'t write PDF File : Please contact webmaster@comcamp.in.th');
						}
					}
				}else{
					show_error('Can\'t generate PDF File : Please contact webmaster@comcamp.in.th');
				}
			}
		}else{
			show_error("Web token must be specific");
		}
	}

	public function testPDF($key){
		if(hash('sha256', $key) !== "9a7339f6eae36dc3962b3e294f3c404a3efaf6225d30a5a30e91d6f0037ec925")
			return show_error("Gimme melon!");
		$id = 465;
		$this->config->load('pdf2');
		$this->load->library('pdf');
		$this->load->helper('facebook_time');
		$printData = $this->config->item('printData');
		$pdfPath = $this->config->item('pdf_path');
		$pdfTemplate = $this->config->item('pdf_template');
		$pdfVersion = filemtime($pdfTemplate);
		$pdfFileName = "comcamp27_v{$pdfVersion}_id{$id}.pdf";
		$pdfFilePath = "{$pdfPath}{$pdfFileName}";
		/*if(is_file($pdfFilePath) && is_readable($pdfFilePath)) {
			$this->_headerPDF($pdfFileName);
			readfile($pdfFilePath);
		}else if(is_writable($pdfPath)){*/
			$userData = $this->user_model->getUserData($id);
			include __DIR__.'/registerData.inc';
			log_message('debug', 'Register => '.print_r($registerData, true));
			log_message('debug', 'userData => '.print_r($userData, true));
			include __DIR__.'/pdf_gen.inc';
			/*if(isset($pdfResult) && is_string($pdfResult) && file_put_contents($pdfFilePath, $pdfResult)){*/
				log_message('debug', filesize($pdfFilePath));
				$this->_headerPDF($pdfFileName, false);
				echo $pdfResult;
			/*}else{
				show_error('Can\'t write PDF File : '.$pdfFilePath);
			}*/
		/*}else{
			show_error('Can\'t generate PDF File : '.$pdfFilePath);
		}*/
	}

	public function add(){
		echo json_encode(array(
			"status"	=> "fail",
			"user"		=> "add",
			"timestamp"	=> time(),
			"reason"	=> "Registration was closed"
		));
		return 1;
		$this->config->load('register_criteria');
		$userConfig = $this->config->item('user');
		$mustHave = $userConfig['must_have'];
		$criteria = $userConfig['register_criteria'];
		if(!$this->_checkWithGoogle()){
			echo json_encode(array(
				"status"	=> "fail",
				"user"		=> "add",
				"timestamp"	=> time(),
				"reason"	=> "Recaptcha Failed. (Are you bot?)"
			));
		}else if(!($token = $this->input->post('token'))){
			echo json_encode(array(
				"status"	=> "fail",
				"user"		=> "add",
				"timestamp"	=> time(),
				"reason"	=> "Token must specific"
			));
		}else if($userdata = $this->input->post('userdata')){
			if(($userArray = json_decode($userdata, true)) && is_array($userArray)){
				$error = array();
				foreach ($mustHave as $rowName) {
					if(!isset($userArray[$rowName])){
						$error[$rowName] = 'Doesn\'t exist.' ;
					}else if(isset($criteria[$rowName])){
						if(is_string($userArray[$rowName]))
							$userArray[$rowName] = preg_replace('/\s+/', " ", preg_replace("/[\n\r\t\s+]/", " ", $userArray[$rowName]));
						if(isset($criteria[$rowName]['regex']) && !preg_match($criteria[$rowName]['regex'], $userArray[$rowName])){
							$error[$rowName] = 'Invalid Regular Expression. |'.$userArray[$rowName] ;
						}else if(isset($criteria[$rowName]['filter']) && !filter_var($userArray[$rowName], $criteria[$rowName]['filter'])){
							$error[$rowName] = 'Invalid Variable Filter.' ;
						}
					}
				}

				if(!empty($error)){
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "add",
						"timestamp"	=> time(),
						"reason"	=> "Variable Unqualified",
						"detail"	=> $error
					));
				}else if(!($fbId = $this->user_model->getFbId($token)) OR $fbId != $userArray['fb_id']){
					log_message('debug', "o.O --> {$fbId}:{$userArray['fb_id']}");
					echo json_encode(array(
						"status"	=> "fail",
						"user"		=> "add",
						"timestamp"	=> time(),
						"reason"	=> "Token Can't used",
						"detail"	=> array("fbid"=>$userArray['fb_id'])
					));
				}else{
					$queryResult = $this->db->select('fb_id')->from('registration_data')->where('fb_id', $fbId)->get();
					if($queryResult->num_rows() > 0){
						echo json_encode(array(
							"status"	=> "fail",
							"user"		=> "add",
							"timestamp"	=> time(),
							"reason"	=> "This user is registered",
							"detail"	=> array("fbid"=>$userArray['fb_id'])
						));
					}else{
						//complex variable
						try {
							$birthDatetime = DateTime::createFromFormat('d/m/Y', $userArray['birthdate']);
						} catch (Exception $e) {
							$birthDatetime = new DateTime('today');
							$error["birthdate"] = 'Invalid format.';
						}

						if(!isset($error["birthdate"])){
							$todayDateTime = new DateTime('today');
							$diffYear      = $birthDatetime->diff($todayDateTime)->y;
							if($diffYear <= 10 OR $diffYear > 30){
								$error["birthdate"] = 'Must between 10 and 30 years.';
							}
						}
						
						if(is_array($userArray['interest_universities'])){
							foreach ($userArray['interest_universities'] as $no => $interestDetail) {
								$no++;
								if(!is_array($interestDetail)){
									$error["interest_universities#{$no}"] = 'Must be an array.';
									continue;
								}else if(count($interestDetail) != 2){
									$error["interest_universities#{$no}"] = 'Must have 3 places';
									continue;
								}

								foreach ($criteria['interest_universities'] as $rowName => $validationArray) {
									if(!isset($interestDetail[$rowName])){
										$error["interest_universities#{$no}_{$rowName}"] = 'Doesn\'t exist.' ;
									}else if(isset($validationArray['regex']) && !preg_match($validationArray['regex'], $interestDetail[$rowName])){
										$error["interest_universities#{$no}_{$rowName}"] = 'Invalid Regular Expression.' ;
									}
								}
							}
						}else{
							$error['interest_universities'] = 'Must be an array.';
						}

						if(isset($userArray['camp']) && !empty($userArray['camp'])){
							if(!is_array($userArray['camp'])){
								$error["camp"] = 'Must be an array.' ;
							}else{
								foreach ($userArray['camp'] as $no => $campDetail) {
									$no++;
									if(!is_array($campDetail)){
										$error["camp#{$no}"] = 'Must be an array.';
										continue;
									}

									foreach ($criteria['camp'] as $rowName => $validationArray) {
										if(!isset($campDetail[$rowName])){
											$error["camp#{$no}_{$rowName}"] = 'Doesn\'t exist.' ;
										}else if(isset($validationArray['regex']) && !preg_match($validationArray['regex'], $campDetail[$rowName])){
											$error["interest_universities#{$no}_{$rowName}"] = 'Invalid Regular Expression.' ;
										}
									}
								}
							}
						}

						if(isset($userArray['practice'])){
							$practiceTypeList = array('interest', 'skill');
							if(!is_array($userArray['practice'])){
								$error["practice"] = 'Must be an array.' ;
							}else{
								$practice = $this->_getPractice();
								foreach ($userArray['practice'] as $practiceType => $practiceDetail) {
									if(!in_array($practiceType, $practiceTypeList)){
										$error["practice#{$practiceType}"] = 'Doesn\'t exist.';
										continue;
									}else if(!is_array($practiceDetail)){
										$error["practice#{$practiceType}"] = 'Must be an array.';
										continue;
									}
									foreach ($practiceDetail as $practiceName) {
										if(!isset($practice[$practiceName])){
											$error["practice_{$practiceName}"] = 'Not exist in list.' ;
										}
									}
								}
							}
						}

						if(!empty($error)){
							echo json_encode(array(
								"status"	=> "fail",
								"user"		=> "add",
								"timestamp"	=> time(),
								"reason"	=> "Complex Variable Unqualified",
								"detail"	=> $error
							));
						}else{ //var is ready to insert
							$this->db->trans_start();
								$mainTable = array(
									'registration_type'	=> 1,
									'edited_by'			=> 0,
									'created'			=> date("Y-m-d H:i:s")
									);
								foreach ($userConfig['main_table'] as $fieldName) {
									$mainTable[$fieldName] = ($fieldName == 'birthdate')?date('Y-m-d', strtotime(str_replace('/', '-', $userArray[$fieldName]))):$userArray[$fieldName];
								}

								$this->db->insert('registration_data', $mainTable);
								$registerId = $this->db->insert_id();

								if(isset($userArray['camp']) && !empty($userArray['camp'])){
									$camp = array();
									foreach ($userArray['camp'] as $campDetail) {
										$camp[] = array(
											'userid'	=> $registerId,
											'camp_name'	=> $campDetail['camp_name'],
											'camp_by'	=> $campDetail['camp_by']
											);
									}
									$this->db->insert_batch('registration_camp', $camp);
								}
								if(isset($userArray['practice']) && !empty($userArray['practice'])){
									$practiceInsert = array();
									foreach ($userArray['practice'] as $practiceType => $practiceDetail) {
										$practiceTypeResult = array_search($practiceType, $practiceTypeList) +1;
										foreach ($practiceDetail as $practiceName) {
											if(!isset($practiceInsert[$practice[$practiceName]])){
												$practiceInsert[$practice[$practiceName]] = array(
													'userid'	=> $registerId,
													'choice'	=> $practice[$practiceName],
													'result'	=> $practiceTypeResult
													);
											}else{
												$practiceInsert[$practice[$practiceName]]['result'] += $practiceTypeResult;
											}
										}
									}
									$this->db->insert_batch('registration_practice', $practiceInsert);
								}

								$interestUniversities = array();
								foreach ($userArray['interest_universities'] as $no => $interestDetail) {
									$interestUniversities[] = array(
										'userid'	=> $registerId,
										'university'=> $interestDetail['university'],
										'faculty'	=> $interestDetail['faculty']
										);
								}
								$this->db->insert_batch('registration_university', $interestUniversities);
							$this->db->trans_complete();
							if ($this->db->trans_status() === FALSE){
								echo json_encode(array(
									"status"	=> "error",
									"user"		=> "add",
									"timestamp"	=> time(),
									"reason"	=> "Cannot add data to Database"
								));
							}else{
								$this->db->insert('registration_status', array(
									'userid'	=> $registerId,
									'status'	=> 1,
									'detail'	=> json_encode(array(
										'method'	=> 'web'
										)),
									'register_id'	=> $registerId
									));
								if($this->db->affected_rows() > 0 && $newToken = $this->user_model->redeemToken($token, true)){
									echo json_encode(array(
										"status"	=> "success",
										"user"		=> "add",
										"timestamp"	=> time(),
										"registration_code"	=> $registerId,
										"token"		=> $newToken
									));
								}else{
									echo json_encode(array(
										"status"	=> "error",
										"user"		=> "add",
										"timestamp"	=> time(),
										"reason"	=> "Cannot add log to Database"
									));
								}
							}
						}
					}
				}
			}else{
				echo json_encode(array(
					"status"	=> "fail",
					"user"		=> "add",
					"timestamp"	=> time(),
					"reason"	=> "Malformed input"
				));
			}
		}else{
			echo json_encode(array(
				"status"	=> "fail",
				"user"		=> "add",
				"timestamp"	=> time(),
				"reason"	=> "No data sent"
			));
		}
	}

	public function count($force = false){
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 2);
			$cacheName = "count_registree";
			if(!is_bool($force)){
				if(in_array(strtolower($force), array('true', 'yes', 'yeah'))) $force = true;
				else if(in_array(strtolower($force), array('false', 'no', 'non'))) $force = false;
				else $force = (bool) $force;
			}

			if(isset($result['error'])){
				return show_error("No permision : {$result['error']}", 200);
			}else if($force || !($json = $this->cache->get($cacheName))){
				$queryResult = $this->db->query("SELECT COUNT(id) AS cnt FROM `registration_data`");
				$row = $queryResult->row_array();
				$json = json_encode(array(
						"status"	=> "success",
						"type"		=> "count",
						"force"		=> $force,
						"timestamp"	=> date('Y-m-d H:i:s'),
						'cnt'		=> $row['cnt']
				));
				$this->cache->save($cacheName, $json);
			}
			echo $json;
		}else{
			show_error("Web token must be specific");
		}
	}

	public function fetch_list($pageno = 0, $count = 10, $force = false){
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 2);
			log_message('debug', 'fetch_list => '.print_r($result, true));
			if(isset($result['error'])){
				show_error("No permision : {$result['error']}", 200);
			}else{
				$pageno = abs((int) $pageno);
				$count = (int) $count;
				if(!is_bool($force)){
					if(in_array(strtolower($force), array('true', 'yes', 'yeah'))) $force = true;
					else if(in_array(strtolower($force), array('false', 'no', 'non'))) $force = false;
					else $force = (bool) $force;
				}



				if($pageno >= 1 && $count > 0){
					$cacheName = "fetch_list:{$pageno}:{$count}:";
				}else{
					$cacheName = "fetch_list:";
				}
				log_message('debug', 'Cahce_name => '.$cacheName);
				if ($force || !($json = $this->cache->get($cacheName))){
					$this->db->select('id, fb_id, fname_th, lname_th, nname_th, registration_type, created');
					if($pageno >= 1 && $count > 0){
						$queryResult = $this->db->get('registration_data', $count, ($pageno-1)*$count);
					}else{
						$queryResult = $this->db->get('registration_data');
					}

					log_message('debug', 'Query_fetch => '.($this->db->last_query()));
					$result = array();
					if($queryResult->num_rows() > 0){
						$idRegis = array();
						foreach ($queryResult->result_array() as $row){
							$idRegis[] = $row['id'];
							$result[$row['id']] = array(
								"id"        => $row['id'],
								"fb_id"		=> $row['fb_id'],
					            "regis_key" => sprintf("27%1d%03d", $row['registration_type'], $row['id']),
					            "first_name"=> $row['fname_th'],
					            "last_name" => $row['lname_th'],
					            "nick_name" => $row['nname_th'],
					            "date"      => $row['created'],
					            'sent_doc'	=> array()
							);
						}
						$queryResult = $this->db->select('registration_upload.userid, registration_upload.file, registration_document.alias')->distinct()->from('registration_upload')->join('registration_document', 'registration_upload.file = registration_document.id')->where_in('registration_upload.userid', $idRegis)->get();
						log_message('debug', 'Upload_fetch => '.($this->db->last_query()));
						if($queryResult->num_rows() > 0){
							foreach ($queryResult->result_array() as $row){
								$result[$row['userid']]['sent_doc'][$row['alias']] = $row['file'];
							}
						}
					}

					$json = json_encode(array(
						"status"	=> "success",
						"type"		=> "{$pageno}/{$count}",
						"force"		=> $force,
						"timestamp"	=> date('Y-m-d H:i:s'),
						'data'		=> $result
					));
					$this->cache->save($cacheName, $json);
				}
				echo $json;
			}
		}
	}

	public function fetch_attachment($id, $file_type){
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 2);
			//log_message('debug', 'fetch_list => '.print_r($result, true));
			if(isset($result['error'])){
				show_error("No permision : {$result['error']}", 200);
			}else{
				$uploadPath = $this->config->item('upload_real_path');
				$id = (int) $id;
				$file_type = (int) $file_type;
				$queryResult = $this->db->select('id, location, confirmed')->from('registration_upload')->where(array(
					'userid'	=> $id,
					'file'		=> $file_type
					))->order_by('confirmed', 'asc')->get();
				$revision = array();
				if($queryResult->num_rows() > 0){
					foreach ($queryResult->result_array() as $row){
						$allFile = glob("{$uploadPath}{$row['location']}.*");
						if(isset($allFile[0])){
							$allFile[0] = explode('.', $allFile[0]);
							$revision[] = array(
								'file_id'	=> $row['id'],
								'uploaded_date'	=> date('Y-m-d H:i:s', $row['confirmed']),
								'extension'	=>	array_pop($allFile[0])
							);
						}
					}					
				}

				echo json_encode(array(
					"status"	=> "success",
					'userid'	=> $id,
					"file_type"	=> $file_type,
					"version"	=> count($revision),
					'revision'	=> $revision
				));
			}
		}else{
			show_error("Web token must be specific");
		}
	}

	public function get_document($id, $file_type){
		/*if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 2);
			//log_message('debug', 'fetch_list => '.print_r($result, true));
			if(isset($result['error'])){
				show_error("No permision : {$result['error']}", 200);
			}else{*/
				$uploadPath = $this->config->item('upload_real_path');
				$id = (int) $id;
				$file_type = (strtolower($file_type)=='preview')?'_preview':'';
				$queryResult = $this->db->select('location')->from('registration_upload')->where('id', $id)->get();
				$revision = array();
				if($queryResult->num_rows() > 0){
					$row = $queryResult->row_array();
					$allFile = glob("{$uploadPath}{$row['location']}.*");
					if(isset($allFile[0])){
						$firstFileName = explode('.', $allFile[0]);
						$ext = array_shift($firstFileName);
						if(strtolower($ext) == 'pdf'){
							$filePath = $allFile[0];
						}else{
							$fileListWithType = glob("{$uploadPath}{$row['location']}{$file_type}.*");
							$filePath = (count($fileListWithType) > 0)?$fileListWithType[0]:$allFile[0];
						}

						if(is_file($filePath)){
							$finfo = finfo_open(FILEINFO_MIME_TYPE);
							$mime = finfo_file($finfo, $filePath);
							finfo_close($finfo);
						    header("Content-Type: {$mime}");
							header("Content-Length: " . filesize($filePath));
							@readfile($filePath);
						}else{
							show_error('File Not Existed', 404);
						}
					}else{
						show_error('File Not Exist', 404);
					}	
				}else{
					show_error('File Not Found', 404);
				}
		/*	}
		}else{
			show_error("Web token must be specific");
		}*/
	}

	public function gen_excel(){
			/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		$cacheName = 'Regis_Excel_v2.01';
		if($token = $this->input->post('code')){
			$result = $this->user_model->checkToken($token, 2);
			if(isset($result['error'])){
				return show_error("No permision : {$result['error']}", 200);
			}else if(!($excelResult = $this->cache->get($cacheName))){
				$this->load->library('excel');
				$this->excel->getProperties()->setCreator("Comcamp 27th")
									 ->setLastModifiedBy("Comcamp 27th")
									 ->setTitle("รายชื่อนักเรียนที่สมัครเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27")
									 ->setSubject("โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27")
									 ->setDescription("รายชื่อนักเรียนที่สมัครเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27 เมื่อ".date('Y-m-d H:i:s'))
									 ->setKeywords("comcamp27 comcamp namelist")
									 ->setCategory("comcamp");
				$this->excel->getDefaultStyle()->getFont()->setName('TH SarabunPSK')->setSize(14);
				//Header
				$this->excel->getActiveSheet()->mergeCells('A1:B1');
				$this->excel->getActiveSheet()->mergeCells('C1:J1');
				//Log Detail
				$this->excel->getActiveSheet()->mergeCells('A2:B2');
				$this->excel->getActiveSheet()->mergeCells('C2:J2');
				$this->excel->setActiveSheetIndex(0)
					//Header
					->setCellValue('C1', 'รายชื่อนักเรียนที่สมัครเข้าโครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27')
					//Log Detail
					->setCellValue('A2', 'ข้อมูลเมื่อ')
		            ->setCellValue('C2', PHPExcel_Shared_Date::PHPToExcel( time() ))
		            //Table Header
		            //	ชื่อ-นามสกุล	ชื่อเล่น	   เบอร์โทรน้อง	 เบอร์ผป.	  โรงเรียน	เอกสาร
		            ->setCellValue('A3', 'รหัสใบสมัคร')
		            ->setCellValue('B3', 'ชื่อ')
		            ->setCellValue('C3', 'นามสกุล')
		            ->setCellValue('D3', 'ชื่อเล่น')
		            ->setCellValue('E3', 'เบอร์โทรน้อง')
		            ->setCellValue('F3', 'เบอร์ ผป.')
		            ->setCellValue('G3', 'โรงเรียน')
		            ->setCellValue('H3', 'เอกสาร')
		            ->setCellValue('I3', 'เวลาที่สมัคร')
		            ->setCellValue('J3', 'FBID')
		            ->setCellValue('K3', 'doc_id');
		        $this->excel->getActiveSheet()->getStyle('C2')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
		        /* Fetching Data*/
		        $queryResult = $this->db->select('registration_data.id, registration_data.fb_id, registration_type, fname_th, lname_th, nname_th, mobile_phone, parent_phone, option_school.name AS school_name, registration_data.created')->join('option_school', 'option_school.schoolid = registration_data.school')->get('registration_data');
		        if($queryResult->num_rows() > 0){
		        	$resultRow = array();
		        	$rowNo = 4;
		        	foreach ($queryResult->result_array() as $row){
		        		$this->excel->getActiveSheet()
		        			->setCellValue("A{$rowNo}", sprintf("27%1d%03d", $row['registration_type'], $row['id']))
		        			->setCellValue("B{$rowNo}", $row['fname_th'])
		        			->setCellValue("C{$rowNo}", $row['lname_th'])
		        			->setCellValue("D{$rowNo}", $row['nname_th'])
		        			->setCellValue("E{$rowNo}", "(".substr($row['mobile_phone'], 0, 3).") ".substr($row['mobile_phone'], 3, 3)."-".substr($row['mobile_phone'],6))
		        			->setCellValue("F{$rowNo}", "(".substr($row['parent_phone'], 0, 3).") ".substr($row['parent_phone'], 3, 3)."-".substr($row['parent_phone'],6))
		        			->setCellValue("G{$rowNo}", $row['school_name'])
		        			->setCellValue("I{$rowNo}", PHPExcel_Shared_Date::PHPToExcel( new DateTime($row['created']) ))
		        			->setCellValue("J{$rowNo}", $row['fb_id']);
		        		$this->excel->getActiveSheet()->getStyle("I{$rowNo}")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
		        		$resultRow[$row['id']] = $rowNo++;
		        	}

					$queryResult = $this->db->select('registration_upload.userid, registration_upload.file, registration_document.document_type')->distinct()->from('registration_upload')->join('registration_document', 'registration_upload.file = registration_document.id')->where_in('registration_upload.userid', array_keys($resultRow))->get();
					if($queryResult->num_rows() > 0){
						$docList = array();
						foreach ($queryResult->result_array() as $row){
							$docList[$row['userid']][$row['file']] = $row['document_type'];
						}

						foreach ($docList as $userid => $doc){
							$this->excel->getActiveSheet()->setCellValue("H{$resultRow[$userid]}", implode(', ', $doc));
							$this->excel->getActiveSheet()->setCellValue("K{$resultRow[$userid]}", implode(', ', array_keys($doc)));
						}
					}
		        }

		        /* Adding Logo */
		        $comcampLogo = realpath(__DIR__.'/../../../../27/assets/img/comcamp_logo.png');
		        if(!empty($comcampLogo) && file_exists($comcampLogo)){
			        $objDrawing = new PHPExcel_Worksheet_Drawing();
					$objDrawing->setName('Comcamp#27 Logo');
					$objDrawing->setDescription('โครงการฝึกอบรมเชิงปฏิบัติการคอมพิวเตอร์​เบื้องต้น ครั้งที่ 27');
					$objDrawing->setPath($comcampLogo);
					$objDrawing->setHeight(42);
					$objDrawing->setCoordinates('A1');
					$objDrawing->setOffsetX(0);
					$objDrawing->setOffsetY(24);
					$objDrawing->setWorksheet($this->excel->getActiveSheet());
				}else{
					$this->excel->setActiveSheetIndex(0)->setCellValue('A1', $comcampLogo);
				}

				/* Styling */
		        $this->excel->getActiveSheet()->setTitle('รายชื่อ');
		        $this->excel->getActiveSheet()->getStyle('C1:J1')->applyFromArray(
						array(
							'font'    => array(
								'bold'      => true
							),
							'alignment' => array(
								'vertical'	 => PHPExcel_Style_Alignment::VERTICAL_CENTER,
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
							),
							'fill' => array(
					 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
					  			'rotation'   => 0,
					 			'startcolor' => array(
					 				'argb' => 'FF131130'
					 			),
					 			'endcolor'   => array(
					 				'argb' => 'FF511F55'
					 			)
					 		)
						)
				);
				$this->excel->getActiveSheet()->getStyle('A1')->applyFromArray(
						array(
							'fill' => array(
					 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
					  			'rotation'   => 0,
					 			'startcolor' => array(
					 				'argb' => 'FF511F55'
					 			),
					 			'endcolor'   => array(
					 				'argb' => 'FF131130'
					 			)
					 		)
						)
				);
				$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(64);
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);

				$this->excel->getActiveSheet()->getStyle('C1')->getFont()
					->setSize(24)
					->setBold(true)
					->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
				$this->excel->getActiveSheet()->getStyle('C1')
					->getAlignment()->setWrapText(true);

				$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A3:K3')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->freezePane('L4');
				$this->excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 3);
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$this->excel->setActiveSheetIndex(0);
				$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
				$tempFileLocation = tempnam("/tmp", 'res');
				$objWriter->save($tempFileLocation);
				$excelResult = file_get_contents($tempFileLocation);
				$this->cache->save($cacheName, $excelResult);
			}

			/* Exporting */
			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Comcamp-web-'.time().'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			echo $excelResult;
		}else{
			show_error("Web token must be specific");
		}
	}

	private function _headerPDF($fileName, $download = true){
		//date_default_timezone_set('Asia/Bangkok');
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Content-type:application/pdf");
		// It will be called downloaded.pdf
		if($download)
			header("Content-Disposition:attachment;filename='{$fileName}'");
		else
			header("Content-Disposition:inline;filename='{$fileName}'");
	}

	private function _checkWithGoogle(){
		$siteKey = $this->config->item('siteKey', 'captcha');
		$secretKey = $this->config->item('secretKey', 'captcha');
		if(!($validationKey = $this->input->post('g-recaptcha-response'))){
			return false;
		}else if(!($googleTxt = file_get_contents('https://www.google.com/recaptcha/api/siteverify?'.http_build_query(array(
					'secret'	=> $secretKey,
					'response'	=> $validationKey
		))))){
			log_message('debug', ";w;    Recaptcha : {$validationKey} => {$googleTxt}");
			return false;
		}else if($result = json_decode($googleTxt, true)){

			if(isset($result['success']) && $result['success']){
				return true;
			}else{
				log_message('debug', "Google Recaptcha : {$validationKey} => {$googleTxt}");
				return false;
			}
		}else{
			return false;
		}
	}

	private function _getPractice(){
		$queryResult = $this->db->select('alias, id')->get('option_practice');
		$result = array();
		foreach($queryResult->result_array() AS $row){
			$result[$row['alias']] = $row['id'];
		}
		return $result;
	}

	private function _getDocumentType(){
		$result = array();
		$queryResult = $this->db->get('registration_document');
		if($queryResult->num_rows() > 0){
			foreach ($queryResult->result_array() as $row){
				$result[$row['id']] = $row;
			}
			return $result;
		}else{
			return $result;
		}
	}

	//private function _validate
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
