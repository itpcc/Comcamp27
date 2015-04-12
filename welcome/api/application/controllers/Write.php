<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database(); 
		/*
		Error code
		1 => input
		101 : No input in
		102 : incorrect input type
		103 : Value must not be empty
		4=> data
		404 Data not found
		*/	
	}

	public function index(){
		$this->config->load('criteria', true);
		print_r($this->config->config);
	}

	public function edit(){
		$this->config->load('criteria', true);
		if(!($id = $this->input->post('id'))){
			$this->_json(array('status' => 'failed', 'reason' => 'No input "ID"', 'errno' => 101), true);
		}else if(!($type = $this->input->post('key'))){
			$this->_json(array('status' => 'failed', 'reason' => 'No input "Type"', 'errno' => 101), true);
		}else if(!($value = $this->input->post('value')) && !in_array($type, array('diase', 'food', 'eat'))){
			$this->_json(array('status' => 'failed', 'reason' => 'No input "Value"', 'errno' => 101), true);
		}else if(!isset($this->config->config['criteria']['allow_field'][$type])){
			$this->_json(array('status' => 'failed', 'reason' => 'Not allowed type', 'errno' => 102, 'sent_type'=>$type), true);
		}else{
			$id = (int) $id;
			switch ($this->config->config['criteria']['allow_field'][$type]) {
				case 'number':
					$value = (int) $value;
					if($value <= 0)
						$value = 0;
				break;
				case 'tel':
					if(preg_match($this->config->config['criteria']['phone'], $value))
						$value = preg_replace("/[^0-9]/", "", $value);
					else
						return $this->_json(array('status' => 'failed', 'reason' => 'Telephone format incorrect', 'errno' => 102, 'input' => $value), true);
				break;
				case 'birth':
					$value = DateTime::createFromFormat('Y-m-d', $value)->getTimestamp();
					if($value > 0 && date('Y', $value) >= 2010) /* No one can borned before 2010!*/
						$value = 0;
					if(!empty($value))
						$value = date('Y-m-d', $value);
				break;
			}

			if($id <= 0){
				$this->_json(array('status' => 'failed', 'reason' => 'incorrect input type', 'errno' => 102, 'input' => $id), true);
			}else if(empty($value) && !in_array($type, array('diase', 'food', 'eat'))){
				$this->_json(array('status' => 'failed', 'reason' => 'Value must not empty', 'errno' => 103, 'input' => $id), true);
			}else{
				$data = array(array($type => $value, 'id' => $id));
				$queryResult = $this->db->update_batch('regis_data', $data, 'id');
				/*if($this->db->affected_rows() > 0){*/
					$this->_json(array('status' => 'success', 'users' => $id));
				/*}else{
					$this->_json(array('status' => 'failed', 'reason' => 'Data not found', 'errno' => 404, 'input'=> array('id'=>$id, $type => $value)), true);
				}*/
			}
		}
	}

	public function upload(){
		if(!($id = $this->input->post('id'))){
			$this->_json(array('status' => 'failed', 'reason' => 'No input "ID"', 'errno' => 101), true);
		}else{ 
			$this->config->load('criteria', true);
			$this->config->config['criteria']['uploadOption']['file_name'] = $id;
			$this->load->library('upload', $this->config->config['criteria']['uploadOption']);
			if(!$this->upload->do_upload($this->config->config['criteria']['uploadOption']['inputName'])){
				$this->_json(array('status' => 'failed', 'reason' => $this->upload->display_errors(), 'errno' => 102), true);
			}else{
				$uploadData = $this->upload->data($this->config->config['criteria']['uploadOption']['inputName']);
				$this->db->update('regis_data', array('upload' => substr($uploadData['file_ext'], 1)), array('id'=>$id));
				$this->_json(array('status' => 'success', 'users' => $id));
			}
		}
	}

	public function submit($id){
		//var_dump($id);
		$id = (int) $id;
		if($id > 0){
			if($this->db->update('regis_data', array('registered'=> time()), array('id'=>$id))){
				$this->_json(array('status' => 'success'));
			}else{
				$this->_json(array('status' => 'error', 'reason'=>$this->db->_error_message(), 'errno'=>500));
			}
		}else{
			$this->_json(array('status' => 'failed', 'reason' => 'incorrect input type', 'errno' => 102, 'input' => $id), true);
		}
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
