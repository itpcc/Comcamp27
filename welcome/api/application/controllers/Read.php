<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Read extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database(); 
		/*
		Error code
		1 => input
		101 : No input in
		102 : incorrect input type
		4=> data
		404 Data not found
		*/	
	}

	public function index(){
		var_dump(filter_var('id513128@gmail.com', FILTER_VALIDATE_EMAIL));
	}

	public function search(){
		if($q = $this->input->post('q')){
			$this->config->load('criteria', true);
			$this->db->select('id, name, sirname, nickname, tel, registered')->order_by('registered', 'DESC');
			$q = trim($q);
			if(filter_var($q, FILTER_VALIDATE_EMAIL)){ //Email
				$this->db->where('email', $q);
			}else if(preg_match($this->config->config['criteria']['phone'], $q)){	//Tel
				$q = preg_replace("/[^0-9]/", "", $q);
				$this->db->where('tel', $q);
			}else if(($spacePos = strpos($q, ' ')) === false){ //Name
				$this->db->like('name', $q);
			}else{	//Name and sirname
				$names = explode(' ', $q);
				$spaceCnt = count($names);
				if($spaceCnt == 1){
					$name = $names[0];
					$sirname = $names[1];
				}else if($spaceCnt == 2){
					if(strlen($names[1]) <= 1){ // ณ ...
						$name = $names[0];
						$sirname = "{$names[1]} {$names[2]}";
					}else{
						$name = "{$names[0]} {$names[1]}";
						$sirname = $names[2];
					}					
				}else if($spaceCnt == 3){
					$name = $names[0];
					$sirname = "{$names[1]} {$names[2]} {$names[3]}";
				}else if($spaceCnt == 4){
					$name = "{$names[0]} {$names[1]}";
					$sirname = "{$names[2]} {$names[3]} {$names[4]}";
				}else{
					$name = '';
					for($i=0; $i <= (int)($spaceCnt/2); $i++)
						$name .= $names[$i];
					$sirname = '';
					for(; $i <= $spaceCnt; $i++)
						$sirname .= $names[$i];
				}
				$this->db->like('name', $name)->like('sirname', $sirname);
			}

			if($section = $this->input->post('section')){
				if((int)$section > 0){
					$this->db->where('section', $section);
				}
			}

			$queryResult = $this->db->get('regis_data');
			if($queryResult->num_rows() > 0){
				$this->_json(array('status' => 'success', 'users' => $queryResult->result_array()));
			}else{
				$this->_json(array('status' => 'failed', 'reason' => 'Data not found', 'errno' => 404, 'input'=>$q), true);
			}

		}else{
			$this->_json(array('status' => 'failed', 'reason' => 'No input', 'errno' => 101), true);
		}
		//var_dump($this->db);
	}

	public function user(){
		if($q = $this->input->post('q')){
			$id = (int) $q;
			if($id > 0){
				$queryResult = $this->db->select('id, registered, name, sirname, nickname, birth, tel, diase, food, eat, travel, section, upload, religion, parent_name, parent_phone, parent_relation')->from('regis_data')->where('id', $id)->get();
				if($queryResult->num_rows() > 0){
					$comic = array(
						1 => array('./api/assets/yaruki-zero-yes.png', './api/assets/nana17.png'),
						2 => array('./api/assets/yaruki-zero-lazy-comic.png', './api/assets/nana10.png'),
						3 => array('./api/assets/yaruki-zero-river.png'),
						4 => array('./api/assets/yaruki-zero-burning.png'),
						5 => array('./api/assets/yaruki-zero-really.png'),
					);
					$row = $queryResult->row_array();
					$row['picture'] = $comic[$row['section']][rand()%count($comic[$row['section']])];
					$this->_json(array('status' => 'success', 'users' => $row));
				}else{
					$this->_json(array('status' => 'failed', 'reason' => 'Data not found', 'errno' => 404, 'input'=>$q), true);
				}
			}else{
				$this->_json(array('status' => 'failed', 'reason' => 'incorrect input type', 'errno' => 102, 'input' => $q), true);
			}
		}else{
			$this->_json(array('status' => 'failed', 'reason' => 'No input', 'errno' => 101), true);
		}	
	}

	public function fetch($pageInput = 1, $perpageInput = 20){
		$page = (int) $pageInput;		if($page < 1) $page = 1;
		$perpage = (int) $perpageInput; if($perpage < 10 OR $perpage > 200) $perpage = 20;

		if($section = $this->input->post('section')){
			if((int)$section > 0){
				$this->db->where('section', $section);
			}
		}

		$queryResult = $this->db->select('id, name, sirname, nickname, tel, registered')->order_by('registered', 'DESC')->get('regis_data');
		if($queryResult->num_rows() > 0){
			$this->_json(array('status' => 'success', 'users' => $queryResult->result_array()));
		}else{
			$this->_json(array('status' => 'failed', 'reason' => 'Data not found', 'errno' => 404), true);
		}
	}	

	public function notification($time = 0){
		$time = (int) $time;
		if($time <= 0)
			$time = time() - (10*60); //10 minute backward
		$queryResult = $this->db->select('id, nickname, registered')->from('regis_data')->where('registered > ', $time)->get();
		if($queryResult->num_rows()>0)
			$data = $queryResult->result_array();
		else
			$data = array();

		$this->_json(array('status' => 'success', 'users' => $data));
	}

	private function _json($var, $forceExit = false){
		$this->output->set_content_type('application/json');
		echo json_encode(
			is_array($var)
			?array('timestamp'	=> time()) + $var
			:$var
		);

		if($forceExit)
			exit;
	}
}
