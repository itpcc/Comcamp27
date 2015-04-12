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

require './autoload.php';
use Mute\Facebook\App;
use Mute\Facebook\Exception\GraphAPIException;

class Facebook {
	var $ci;
	var $helper;
	var $session;
	var $permissions;
	private $userData;

	public function __construct() {
		$this->ci =& get_instance();
		$this->ci->config->load('facebook');
		$this->permissions = $this->ci->config->item('permissions', 'facebook');

		// Initialize the SDK
		var_dump($this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook') );
		FacebookSession::setDefaultApplication( $this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook') );

		// Create the login helper and replace REDIRECT_URI with your URL
		// Use the same domain you set for the apps 'App Domains'
		// e.g. $helper = new FacebookRedirectLoginHelper( 'http://mydomain.com/redirect' );
		$this->helper = new FacebookRedirectLoginHelper( $this->ci->config->item('redirect_url', 'facebook') );

		/*if ( $this->ci->session->userdata('fb_token') ) {
			$this->session = new FacebookSession( $this->ci->session->userdata('fb_token'));

			// Validate the access_token to make sure it's still valid
			try {
				if ( ! $this->session->validate() ) {
					$this->session = null;
				}
			} catch ( Exception $e ) {
				// Catch any exceptions
				$this->session = null;
			}
		} else {
			// No session exists
			try {
				$this->session = $this->helper->getSessionFromRedirect();
			} catch( FacebookRequestException $ex ) {
				// When Facebook returns an error
			} catch( Exception $ex ) {
				// When validation fails or other local issues
			}
		}

		if ( $this->session ) {
			$this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );

			$this->session = new FacebookSession( $this->session->getToken() );
		}*/
	}

	/**
	 * Returns the login URL.
	 */
	public function login_url() {
		return $this->helper->getLoginUrl( $this->permissions );
	}

	/**
	 * Returns the access Token.
	 */
	public function get_token(){
		if($this->session){
			if(!$this->ci->session->userdata('fb_token')){
				$this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );
			}
			return $this->session->getToken();
		}else if($token = $this->ci->session->userdata('fb_token')){
			if($this->set_token($token))
				return $token;
		}else{
			// No session exists
			try {
				$this->session = $this->helper->getSessionFromRedirect();
				if($this->session)
					return $this->session->getToken();
			} catch( FacebookRequestException $ex ) {
				return false;
				// When Facebook returns an error
			} catch( Exception $ex ) {
				return false;
				// When validation fails or other local issues
			}
		}
		return false;
	}

	/**
	* Set token both from
	*/
	public function set_token($token){
		if(!is_string($token) OR empty($token)){
			throw new Exception("Facebook token must be a string", 1);			
			return false;
		}
		$this->session = new FacebookSession( $token );

		// Validate the access_token to make sure it's still valid
		try {
			if ( ! $this->session->validate() ) {
				$this->session = null;
				return false;
			}
		} catch ( Exception $e ) {
			// Catch any exceptions
			$this->session = null;
			return false;
		}

		return true;
	}

	/**
	 * Returns the current user's info as an array.
	 */
	public function get_user($forceRenew = false) {
		if(!$forceRenew && !empty($this->userData)){
			return $this->userData;
		}else if ( $this->session OR $this->get_token()) {
			/**
			 * Retrieve User’s Profile Information
			 */
			// Graph API to request user data
			$requestObj = new FacebookRequest( $this->session, 'GET', '/me' );
			$request = $requestObj->execute();

			// Get response as an array
			$this->userData = $request->getGraphObject()->asArray();

			return $this->userData;
		}
		return false;
	}
}
