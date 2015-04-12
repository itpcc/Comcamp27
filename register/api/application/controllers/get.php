<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Get extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	function __construct(){
		parent::__construct();
		//$this->output->set_content_type('application/json');
		$this->load->database();
		$this->load->driver('cache', array('adapter' => 'file'/*, 'backup' => 'file'*/));
	}

	public function index(){
		echo realpath('/domains/comcamp.in.th/cache/'), '<br/ >';
		echo 'OK';
		//show_error("Please show an data you want to list");
	}

	public function time(){
		echo date('D M d Y H:i:s O');
	}

	public function address($typeOfLocation = 'province', $id = 0){
		if(!is_numeric($id)){
			return show_error('ID must be an integer');
		}

		$typeOfLocation = strtolower($typeOfLocation);
		$id = (int) $id;

		if($typeOfLocation !== 'province' && $id < 1){
			return show_error('id must spectific');
		}

		switch($typeOfLocation){
			case 'province' :
				$table = 'address_province';
				$idField = 'PROVINCE_ID';
				$nameField = 'PROVINCE_NAME';
				$searchField = 'GEO_ID';
			break;
			case 'amphur' :
				$table = 'address_amphur';
				$idField = 'AMPHUR_ID';
				$nameField = 'AMPHUR_NAME';
				$searchField = 'PROVINCE_ID';
			break;
			case 'district' :
				$table = 'address_district';
				$idField = 'DISTRICT_CODE';
				$nameField = 'DISTRICT_NAME';
				$searchField = 'AMPHUR_ID';
			break;
			case 'postal' :
				$table = 'address_zipcode';
				$idField = 'ZIPCODE_ID';
				$nameField = 'DISTRICT_CODE';
				$searchField = 'ZIPCODE';
			break;
			default:
				return show_error('No keys selected in this case');
			break;
		}

		$cacheName = md5("address:{$idField}:{$nameField}:{$id}");
		if (!($json = $this->cache->get($cacheName))){
			$this->db->select("{$idField}, {$nameField}")->from($table);
			if($typeOfLocation !== 'province' && $id >= 1)
				$this->db->where($searchField, $id);
			$queryResult = $this->db->get();

			if($queryResult->num_rows() > 0){
				$result = array();
				foreach ($queryResult->result_array() AS $row) {
					$result[$row[$idField]] = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '',$row[$nameField]);
				}

				//var_dump($result);
				$json = json_encode(array(
						"status"	=> "success",
						$typeOfLocation => $id,
						"timestamp"	=> time(),
						"result"	=> $result
					));
			}else{
				$json = json_encode(array(
					"status"	=> "fail",
					$typeOfLocation => $id,
					"timestamp"	=> time(),
					"reason"	=> "{$typeOfLocation} with ID #{$id} is not found."
				));
			}
			$this->cache->save($cacheName, $json);
		}

		echo $json;
	}

	public function district($id){
		$cacheName = md5("district:{$id}");
		if(!is_numeric($id)){
			return show_error('ID must be an integer');
		}else if(($id = (int) $id) <= 0){
			return show_error('ID must be a positive integer');
		}else if(!($json = $this->cache->get($cacheName))){
			$this->db->select("
				`address_district`.`DISTRICT_NAME`,
				`address_district`.`DISTRICT_CODE`, 
				`address_amphur`.`AMPHUR_NAME`, 
				`address_amphur`.`AMPHUR_ID`, 
				`address_province`.`PROVINCE_NAME`,
				`address_province`.`PROVINCE_ID`,
				`address_zipcode`.`ZIPCODE`
				")
			->from("address_zipcode")
			->join("address_district", "address_district.DISTRICT_ID = address_zipcode.DISTRICT_ID")
			->join("address_amphur", "address_amphur.AMPHUR_ID = address_zipcode.AMPHUR_ID")
			->join("address_province", "address_province.PROVINCE_ID = address_zipcode.PROVINCE_ID")
			->where("`address_zipcode`.`DISTRICT_CODE`", $id);

			$queryResult = $this->db->get();
			//var_dump($this->db->last_query());
			if($queryResult->num_rows() > 0){
				$row = $queryResult->row();
				$json = json_encode(array(
					"status"	=> "success",
					"district" 	=> $id,
					"timestamp"	=> time(),
					"result"	=> array(
						"district"	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row->DISTRICT_NAME),
						"district_id"	=> $row->DISTRICT_CODE,
						"amphur"	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row->AMPHUR_NAME),
						"amphur_id"		=> $row->AMPHUR_ID,
						"provinces"	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row->PROVINCE_NAME),
						"province_id"	=> $row->PROVINCE_ID,
						"zipcode"	=> $row->ZIPCODE
					)
				));
			}else{
				$json = json_encode(array(
					"status"	=> "fail",
					"district" 	=> $id,
					"timestamp"	=> time(),
					"reason"	=> "District with ID #{$id} is not found."
				));
			}
			$this->cache->save($cacheName, $json);
		}
		echo $json;
	}

	public function education($schoolType, $province){
		$cacheName = ($schoolType==="university")?md5("edu:{$schoolType}"):md5("edu:{$schoolType}:{$province}");
		if (!($json = $this->cache->get($cacheName))){
			switch(strtolower($schoolType)){
				case 'university' : 
					$this->db->select('schoolid, name')->from('option_school')->where(array(
						'school_type'	=> 2,
						'confirmed'		=> 1
						));
					$queryResult = $this->db->get();
					if($queryResult->num_rows() > 0){
						$result = array();
						foreach ($queryResult->result_array() as $row) {
							$result[$row['schoolid']] = $row['name'];
						}
						$json = json_encode(array(
							"status"	=> "success",
							'university' => true,
							"timestamp"	=> time(),
							"result"	=> $result
						));
					}else{
						$json = json_encode(array(
							"status"	=> "fail",
							'university' => true,
							"timestamp"	=> time(),
							"reason"	=> "University is not found."
						));
					}
				break;
				case 'school' : 
					if(!is_numeric($province) || $province <= 0){
						return show_error('Province of school must be an integer');
					}else{
						$this->db->select('schoolid, name')->from('option_school')->where(array(
							'school_type'	=> 1,
							'province'		=> $province,
							'confirmed'		=> 1
						));
						$queryResult = $this->db->get();
						if($queryResult->num_rows() > 0){
							$result = array();
							foreach ($queryResult->result_array() as $row) {
								$result[$row['schoolid']] = $row['name'];
							}
							$json = json_encode(array(
								"status"	=> "success",
								'school' 	=> $province,
								"timestamp"	=> time(),
								"result"	=> $result
							));
						}else{
							$json = json_encode(array(
								"status"	=> "fail",
								'school' 	=> $province,
								"timestamp"	=> time(),
								"reason"	=> "School in province#{$province} is not found."
							));
						}
					}
				break;
				default:
					return show_error('School is doesn\'t match');
				break;
			}
			$this->cache->save($cacheName, $json);
		}
		echo $json;
	}

	public function misc($type){
		$cacheName = md5("misc:{$type}");
		//echo $cacheName;
		if (!($json = $this->cache->get($cacheName))){
			switch ($type) {
				case 'class_type':
					$tableName = 'option_class_type';
					$idFeild   = 'id';
					$textField = 'class_type';
				break;
				case 'file_type':
					$tableName = 'registration_document';
					$idFeild   = 'id';
					$textField = 'document_type';
				break;
				case 'religion':
					$tableName = 'option_religion';
					$idFeild   = 'id';
					$textField = 'religion';
				break;
				case 'shirt':
					$tableName = 'option_shirt';
					$idFeild   = 'id';
					$textField = 'size';
				break;
				case 'type':
					$tableName = 'registration_type';
					$idFeild   = 'id';
					$textField = 'registration_type';
				break;
				case 'doc':
					$tableName = 'registration_document';
					$idFeild   = 'id';
					$textField = 'document_type';
				break;
				
				default:
					$json = json_encode(array(
						"status"	=> "fail",
						'misc'		=> $type,
						"timestamp"	=> time(),
						"reason"	=> "Unknown misc data type."
					));
				break;
			}
			//var_dump('json', $tableName);

			if(isset($tableName)){
				$this->db->select("{$idFeild}, {$textField}")->from($tableName);
				$queryResult = $this->db->get();
				if($queryResult->num_rows() > 0){
					$result = array();
					foreach ($queryResult->result_array() as $row) {
						$result[intval($row[$idFeild])] = $row[$textField];
					}
					$json = json_encode(array(
						'status'	=> 'success',
						'misc' 		=> $type,
						'timestamp'	=> time(),
						'result'	=> $result
					));
				}
			}

			$this->cache->save($cacheName, $json);
		}
		echo $json;
	}

	public function test(){
		echo realpath('/domains/comcamp.in.th/cache/');
	}

}

/* End of file get.php */
/* Location: ./application/controllers/get.php */
