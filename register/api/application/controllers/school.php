<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	private $sqlite;

	function __construct(){
		parent::__construct();
		//$this->output->set_content_type('application/json');
		date_default_timezone_set('Asia/Bangkok');
		$this->load->database();
		$this->load->model('user_model');
		$this->load->driver('cache', array('adapter' => 'file'/*, 'backup' => 'file'*/));
	}

	public function search($province){
		if(!($token = $this->input->post('code'))){
			echo json_encode(array(
				"status"	=> "fail",
				"school"	=> "search",
				"timestamp"	=> time(),
				"reason"	=> "Web token must be specific"
			));
		}else{
			$result = $this->user_model->checkToken($token, -1);
			if(isset($result['error'])){
				echo json_encode(array(
					"status"	=> "fail",
					"school"	=> "search",
					"timestamp"	=> time(),
					"reason"	=> $result['error']
				));
			}else if(!($province = (int) $province)){
				echo json_encode(array(
					"status"	=> "fail",
					"school"	=> "search",
					"timestamp"	=> time(),
					"reason"	=> "Province must be an integer"
				));
			}else if(!($keyword = $this->input->post('q'))){
				echo json_encode(array(
					"status"	=> "fail",
					"school"	=> "search",
					"timestamp"	=> time(),
					"reason"	=> "Keyword must be specific"
				));
			}else{
				$cacheName = md5("school:{$keyword}");
				if (!($json = $this->cache->get($cacheName))){
					$queryResult = $this->db->select('id, name')->from('school_list')->where('province', $province)->like('name', $keyword)->get();
					if($queryResult->num_rows() <= 0){
						echo json_encode(array(
							"status"	=> "fail",
							"school"	=> "search",
							"timestamp"	=> time(),
							"reason"	=> "School not found"
						));
					}else{
						$result = $queryResult->result_array();

						$json = json_encode(array(
							"status"	=> "success",
							"school"	=> "search",
							"timestamp"	=> time(),
							"result"	=> $result
						));
						$this->cache->save($cacheName, $json);
					}
				}
				echo $json;
			}
		}
	}

	public function add($schoolId){
		if(!($token = $this->input->post('code'))){
			echo json_encode(array(
				"status"	=> "fail",
				"school"	=> "add",
				"timestamp"	=> time(),
				"reason"	=> "Web token must be specific"
			));
		}else if(!($schoolId = (int) $schoolId)){
			echo json_encode(array(
				"status"	=> "fail",
				"school"	=> "add",
				"timestamp"	=> time(),
				"reason"	=> "School ID must be specific"
			));
		}else{
			$result = $this->user_model->checkToken($token, -1);
			if(isset($result['error'])){
				echo json_encode(array(
					"status"	=> "fail",
					"school"	=> "add",
					"timestamp"	=> time(),
					"reason"	=> $result['error']
				));
			}else{
				$queryResult = $this->db->select('id, name, province')->from('school_list')->where('id', $schoolId)->get();
				if($queryResult->num_rows() <= 0){
					echo json_encode(array(
						"status"	=> "fail",
						"school"	=> "add",
						"timestamp"	=> time(),
						"reason"	=> "School not found"
					));
				}else{
					$row = $queryResult->row_array();
					$queryResult = $this->db->select('id')->from('option_school')->where('schoolid', $row['id'])->get();
					if($queryResult->num_rows() > 0){
						$this->db->delete('school_list', array('id'	=> $row['id']));
						echo json_encode(array(
							"status"	=> "success",
							"school"	=> "add",
							"timestamp"	=> time(),
							"detail"	=> "{$row['name']} มีอยู่ในบัญชีอยู่แล้ว"
						));
						$this->cache->clean();
					}else{
						$this->db->insert('option_school', array(
							'school_type'	=> 1,
							'schoolid'		=> $row['id'],
							'name'			=> $row['name'],
							'province'		=> $row['province'],
							'confirmed'		=> 1,
							'created'		=> date("Y-m-d H:i:s")
						));
						if($this->db->affected_rows() > 0){
							$this->db->delete('school_list', array('id'	=> $row['id']));
							echo json_encode(array(
								"status"	=> "success",
								"school"	=> "add",
								"timestamp"	=> time(),
								"detail"	=> "{$row['name']} added"
							));
							$this->cache->clean();
						}else{
							echo json_encode(array(
								"status"	=> "fail",
								"school"	=> "add",
								"timestamp"	=> time(),
								"reason"	=> "{$row['name']} can't added"
							));
						}
					}
				}
			}
		}
	}
}