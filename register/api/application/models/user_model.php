<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
ini_set('display_errors', 1);

class User_model extends CI_Model {

	private $token	= array();
	private $id 	= array();
	private $ip;

	function __construct(){
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->library('facebook');
		$this->load->helper('facebook_time');
		$this->ip = ip2long($this->input->ip_address());
		//Delete overtime token
		$overTime = (int) $this->config->item('token_time');
		$this->db->delete('registration_token', array('edited < ' => date('Y-m-d H:i:s', time() - $overTime)));
	}

	private function _generateToken(){
		return function_exists("openssl_random_pseudo_bytes")?bin2hex(openssl_random_pseudo_bytes(32)):sha1(mt_rand());
	}

	public function checkToken($token, $permision, $returnPermission = false){
		if(!is_numeric($permision) OR !is_string($token)){
			return array('error'=>'Malformed parameter');
		}else if(isset($this->token[$token]) && ($this->token[$token]['permision'] == $permision OR $permision == -1)){
			return $this->token[$token];
		}else{
			if($permision !== -1){
				$queryCondition = array(
					"token LIKE "	=> $token,
					"ip"			=> $this->ip,
					"permision"	=> $permision
				);
			}else{
				$queryCondition = array(
					"token LIKE "	=> $token,
					"ip"			=> $this->ip
				);
			}
			$this->db
				->select("token, fbid, is_used, permision")
				->from("registration_token")
				->where($queryCondition);
			$queryResult = $this->db->get();
			if($queryResult->num_rows() > 0){
				$row = $queryResult->row_array();
				if($row['is_used'] == 0){
					$this->token[$token] = array(
						'id'			=> $row['fbid'],
						'permision'		=> $row['permision']
						);
					return $this->token[$token];
				}else{
					//log_message('debug', $this->db->last_query());
					return array('error'=>'This token is used');
				}
			}else{
				//log_message('debug', "Query => {$permision} : ".($this->db->last_query()));
				return array('error'=>'Token not found');
			}
		}
	}

	public function getToken($fbToken, $permision, &$reason){
		$user = $this->facebook->get_user($fbToken);
		if(isset($user['error'])){
			$reason = is_string($user['error'])?$user['error']:print_r($user['error'], true);
			return false;
		}else{
			$fbid = $user['id'];
			$this->db
				->select("token, is_used")
				->from("registration_token")
				->where(array(
					"fbid"	=> $fbid,
					"ip"	=> $this->ip,
					"permision" => $permision
					));
			$queryResult = $this->db->get();
			if($queryResult->num_rows() > 0){
				$row = $queryResult->row_array();
			}

			if(!isset($row) OR !isset($row['token']) OR !isset($row['is_used']) OR $row['is_used'] != 0){
				$token = $this->_generateToken();
				$this->token[$token] = array(
					'id'			=> $fbid,
					'permision'	=> $permision
					);
				$this->db->insert("registration_token", array(
					"token"	=> $token,
					"fbid"	=> $fbid,
					"ip"	=> $this->ip,
					"permision"	=> $permision,
					"is_used"	=> 0,
					"created"	=> date('Y-m-d H:i:s')
				));
				return $token;
			}else if(isset($row['token'])){
				return $row['token'];
			}
		}			
	}

	public function getFbId($token){
		$result = $this->checkToken($token, -1);
		if(empty($result['error'])){
			return $this->token[$token]['id'];
		}else{
			log_message('debug', 'o.O=> '.print_r($result, true));
			return false;
		}
	}

	public function getRegisterId($fbid, $isFbId = true){
		if(isset($this->id[$fbid])){
			return $this->id[$fbid];
		}else{
			$this->db->select('id');
			if(is_numeric($fbid) OR $isFbId){
				$this->db->where('fb_id', $fbid);
			}else{
				$this->db
					->join('registration_token', 'registration_token.fbid = registration_data.fb_id')
					->where('registration_token.token', $fbid);
			}

			$queryResult = $this->db->get('registration_data', 1, 0);
			if($queryResult->num_rows() == 0){
				return false;
			}else{
				$row = $queryResult->row_array();
				$this->id[$fbid] = $row['id'];
				return $row['id'];
			}
		}
	}

	public function redeemToken($token, $renewToken = false){
		if(!is_string($token))
			return false;
		$this->db->where('token', $token)->update('registration_token', array('is_used'	=> time()));
		if($this->db->affected_rows() <= 0){
			return false;
		}else if($renewToken){
			$row = $this->db->select('permision, fbid')->from('registration_token')->where('token', $token)->get()->row_array();
			$newToken = $this->_generateToken();
			$this->token[$newToken] = array(
				'id'			=> $row['fbid'],
				'permision'		=> $row['permision']
				);
			$this->db->insert("registration_token", array(
				"token"	=> $newToken,
				"fbid"	=> $row['fbid'],
				"ip"	=> $this->ip,
				"permision"	=> $row['permision'],
				"is_used"	=> 0,
				"created"	=> date('Y-m-d H:i:s')
			));
		}
		if(isset($this->token[$token])){
			unset($this->token[$token]);
		}
		return isset($newToken)?$newToken:true;
	}

	public function getUserData($id, $isFbId = false){
		$this->config->load('register_criteria');
		$mainTable = $this->config->item('main_table', 'user');
		$this->db
			->select(implode(', ', array(
				'registration_data.id',
				'registration_data.'.implode(', registration_data.', $mainTable),
				'option_religion.religion',
				'option_shirt.size',
				'option_class_type.class_type',
				'option_school.name',
				'option_travel.place',
				'option_travel.alias AS travel_alias',
				'registration_type.registration_type'
				)))
			->join('option_religion',	'option_religion.id = registration_data.religion')
			->join('option_shirt', 		'option_shirt.id = registration_data.shirt_size')
			->join('option_class_type', 'option_class_type.id = registration_data.class_type')
			->join('option_school', 	'option_school.schoolid = registration_data.school')
			->join('option_travel', 	'option_travel.id = registration_data.travel', 'left')
			->join('registration_type', 'registration_type.id = registration_data.registration_type');
		if($isFbId){
			$this->db
				->where(
					'fb_id', 
					$id
				);
		}else{
			$this->db
				->where(
					'registration_data.id', 
					$id
				);
		}
		$this->db->from('registration_data');
		$queryResult = $this->db->get();
		if($queryResult->num_rows() > 0){
			$registered = true;
			$row = $queryResult->row_array();
			$userdata = array(
				'registered'	=> true,
				'id'			=> $row['id'],
				"first_name"	=> $row['fname_th'],
				"last_name" 	=> $row['lname_th'],
				"gender"		=> ($row['gender'] > 1)?'female':'male'
			);
			foreach($row AS $rowName => $rowValue){
				$rowValue = trim($rowValue);
				if(!empty($rowValue))
					$userdata[$rowName] = $rowValue;
			}
			$tmpPlaceId = $userdata['travel'];
			$userdata['travel'] = empty($userdata['place'])?"เดินทางด้วยตนเอง":$userdata['place'];
			$userdata['travel_id'] = $tmpPlaceId;
			unset($userdata['place']);

			$addressSplit = array(
				'home_village' 	=> $row['home_village'], 
				'parent_village'=> $row['parent_village']
			);
			$this->db->select("
				`address_district`.`DISTRICT_NAME`,
				`address_district`.`DISTRICT_CODE`, 
				`address_district`.`DISTRICT_ID`, 
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
			->where_in("`address_zipcode`.`DISTRICT_CODE`", $addressSplit);
			$queryResult = $this->db->get();
			if($queryResult->num_rows() > 0){
				$addressList = array();
				foreach ($queryResult->result_array() as $row) {
					$addressList[$row['DISTRICT_CODE']] = array(
						'district'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['DISTRICT_NAME']),
						'district_code'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['DISTRICT_CODE']),
						/*'district_id'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['DISTRIC_code']),*/
						'amphur'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['AMPHUR_NAME']),
						'amphur_id'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['AMPHUR_ID']),
						'province'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['PROVINCE_NAME']),
						'province_id'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['PROVINCE_ID']),
						'zipcode'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['ZIPCODE'])
					);
				}

				foreach ($addressSplit as $rowName => $districtCode){
					if(isset($addressList[$districtCode]))
						$userdata[$rowName] = $addressList[$districtCode];
				}
			}
			$queryResult = $this->db
				->select('address_province.PROVINCE_NAME, option_school.name')
				->join("address_province", "address_province.PROVINCE_ID = option_school.province")
				->where('option_school.schoolid', $userdata['school'])
				->get('option_school', 1, 0);
			if($queryResult->num_rows() > 0){
				$row = $queryResult->row_array();
				$userdata['school'] = array(
					'school'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['name']),
					'school_id'		=> $userdata['school'],
					'province'		=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $row['PROVINCE_NAME']),
					'province_id'	=> $userdata['school_province']
				);
				unset($userdata['school_province']);
			}

			$queryResult = $this->db
				->select('registration_practice.choice, registration_practice.result, option_practice.name, option_practice.alias')
				->join("option_practice", "option_practice.id = registration_practice.choice")
				->where('registration_practice.userid', $userdata['id'])
				->get('registration_practice');
			if($queryResult->num_rows() > 0){
				$userdata['skill'] = array(
					'interest' => array(), 
					'practice' => array()
				);
				foreach ($queryResult->result_array() as $row){
					$row['result'] = ((int)$row['result']);
					if($row['result'] == 1 OR $row['result'] == 3){ //interest
						$userdata['skill']['interest'][] = array(
							"name"	=> $row['name'],
							"alias"	=> $row['alias']
						);
					}
					if($row['result'] == 2 OR $row['result'] == 3){ //interest
						$userdata['skill']['practice'][] = array(
							"name"	=> $row['name'],
							"alias"	=> $row['alias']
						);
					}
				}
			}

			$queryResult = $this->db
				->select('registration_university.university, registration_university.faculty, option_school.name')
				->join('option_school', 'registration_university.university = option_school.schoolid')
				->where('userid', $userdata['id'])
				->get('registration_university');
			if($queryResult->num_rows() > 0){
				$userdata['interest_universities'] = array();
				foreach ($queryResult->result_array() as $row){
					$userdata['interest_universities'][] = array(
						'faculty'	=> $row['faculty'],
						'university'=> (is_numeric($row['university']) && !empty($row['name']))?$row['name']:$row['university']
						);
				}
			}

			$queryResult = $this->db
				->select('camp_name, camp_by')
				->where('userid', $userdata['id'])
				->get('registration_camp');
			if($queryResult->num_rows() > 0){
				$userdata['camp_joined'] = array();
				foreach ($queryResult->result_array() as $row){
					$userdata['camp_joined'][] = array(
						'name'		=> $row['camp_name'],
						'university'=> $row['camp_by']
						);
				}
			}

			$userdata['sent_doc'] 	= array();
			$userdata['status'] 	= array();

			return $userdata;
		}else if($isFbId){
			$facebookUser = $this->facebook->get_simple($id);
			if(!isset($facebookUser['error'])){
				$registered = false;					
				return array(
					'registered'	=> false,
					'id'			=> $id,
					"first_name"	=> $facebookUser['first_name'],
					"last_name" 	=> $facebookUser['last_name'],
					"gender"		=> $facebookUser['gender']
				);
			}else{
				return array("error"	=> $facebookUser['error']);
			}
		}else{
			return array("error"	=> "user not found");
		}
	}
}