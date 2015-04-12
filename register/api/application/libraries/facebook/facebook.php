<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ( function_exists('session_status')?(session_status() == PHP_SESSION_NONE):(session_id() === '') ) {
	session_start();
}

/*require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'Facebook'.DIRECTORY_SEPARATOR.'autoload.php');

// Autoload the required files
require_once( dirname(__FILE__).'\FacebookRedirectLoginHelper.php' );
require_once( dirname(__FILE__).'\FacebookSDKException.php' );
require_once( dirname(__FILE__).'\FacebookSession.php' );
require_once( dirname(__FILE__).'\FacebookRequest.php' );


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;*/

require __DIR__.'/autoload.php';
use Mute\Facebook\App;
use Mute\Facebook\Exception\GraphAPIException;

class Facebook {
	var $ci;
	var $dialogUrl;
	var $session;
	var $permissions;
	var $OAuth;
	var $param;
	private $userData = array();

	public function __construct() {
		$this->ci =& get_instance();
		//$this->ci->load->library('session');
		$this->ci->config->load('facebook');
		$this->permissions = $this->ci->config->item('permissions', 'facebook');

		// Initialize the SDK
		//var_dump($this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook') );
		if(!($state = $this->ci->session->userdata('state'))){
			$state = md5(uniqid(rand(), true));
			$this->ci->session->set_userdata('state', $state);
		}

		$this->session 		= new App($this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook'));
		$this->OAuth 		= $this->session->getOAuth();
		$this->dialogUrl 	= $this->OAuth->getCodeURL($this->ci->config->item('redirect_url', 'facebook'), $this->permissions, $state);
	}

	/**
	 * Returns the login URL.
	 */
	public function login_url() {
		return $this->dialogUrl;
	}

	/**
	* Set token both from
	*/
	public function get_user($token){
		if(!is_string($token) OR empty($token)){
			throw new Exception("Facebook token must be a string", 1);			
			return false;
		}else if(isset($this->userData[$token])){
			return $this->userData[$token];
		}

		$user = array();
		try{
			$user = $this->session->get('me', array(
				'access_token' => $token,  
			));
		}catch(Exception $e){
			$user = array('error' => $e->getMessage());
			//var_dump($e->getData());
			//return array('error'=>'Graph error:');
		}
		if(!isset($user['error'])){
			$this->userData[$token] = $user;
		}
		return $user;
	}

	public function get_simple($facebookId){
		if(!is_numeric($facebookId)){
			return array('error' => "Facebook ID must be an decimal");
		}else if(isset($this->userData[$facebookId])){
			return $this->userData[$facebookId];
		}

		try{
			$user = $this->session->get($facebookId);
		}catch(Exception $e){
			$user = array('error' => $e->getMessage());
			var_dump($e->getData());
			//return array('error'=>'Graph error:');
		}

		if(!isset($user['error'])){
			$this->userData[$facebookId] = $user;
		}
		return $user;
	}
}
