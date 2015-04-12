<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	}

	public function index(){
		if($token = $this->input->post('code')){
			var_dump($this->user_model->getToken($token, 1));
		}
		//var_dump($this->facebook->get_user($this->input->post('code')));
		echo $this->input->ip_address();
		//echo $this->facebook->login_url();
	}

	public function login(){
		$this->token();
	}

	public function token(){
		$adminList = $this->config->item('admin_id');
		if($fbToken = $this->input->post('code')){
			if(!($token = $this->user_model->getToken($fbToken, 2, $reason))){
				echo json_encode(array(
					"status"	=> "fail",
					"FBToken"	=> $fbToken,
					"timestamp"	=> time(),
					"reason"	=> "Fail to request a token : {$reason}"
				));
			}/*else if(!($fbId = $this->user_model->getFbId($token)) OR !in_array($fbId, $adminList)){
				$this->user_model->deleteToken($token);
				echo json_encode(array(
					"status"	=> "fail",
					"FBToken"	=> $fbToken,
					"timestamp"	=> time(),
					"reason"	=> "No Facebook ID , {$fbId}, in admin list"
				));
			}*/else{
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
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
