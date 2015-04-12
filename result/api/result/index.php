<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500); exit;
	define('BASEPATH', realpath(__DIR__.'/../'));
	session_start();
	function ip_address(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	if(!isset($_POST['q']) OR empty($_POST['q'])){
		die(json_encode(array(
			'status'	=> 'fail',
			'reason'	=> 'No Query data found',
			'reason_code'=> 101,
			'timestamp'	=> date('Y-m-d H:i:s')
		)));
	}/*else if(!isset($_SESSION['token_CSRF']))
		die(json_encode(array(
			'status'	=> 'fail',
			'reason'	=> 'No CSRF key found',
			'timestamp'	=> date('Y-m-d H:i:s')
		)));
	*/
	require '../confignaja.inc.php';
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){

		require_once("../phpfastcache.php");
		phpFastCache::setup("storage","auto");
		$cacheObj = phpFastCache();
		$cacheResult = $cacheObj->get(hash('sha256', "Google : {$_POST['g-recaptcha-response']}"));
		if($cacheResult == null OR !is_numeric($cacheResult) OR ($cacheResult < (time() - 10*60))){ //If appspot doesn't send data before, let do it by itself.
			$useCache = false;
			$opts = array('http' =>array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => http_build_query(array(
					'secret'	=> $_setting['secretKey'],
					'response'	=> $_POST['g-recaptcha-response'],
					'remoteip'	=> ip_address()
				))
			));
			$context  = stream_context_create($opts);
			if($googleTxt = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context)){
				if($result = json_decode($googleTxt, true)){
					if(!isset($result['success']) OR !$result['success']){
						if(isset($result['error-codes'])){
							die(json_encode(array(
								'status'	=> 'fail',
								'reason'	=> 'Malformed reCAPTCHA result : '.$result['error-codes'],
								'reason_code'=> 201,
								'timestamp'	=> date('Y-m-d H:i:s')
							)));
						}else{
							die(json_encode(array(
								'status'	=> 'fail',
								'reason'	=> 'Unknown reCAPTCHA result',
								'reason_code'=> 202,
								'timestamp'	=> date('Y-m-d H:i:s')
							)));
						}
					}
				}else{
					die(json_encode(array(
						'status'	=> 'fail',
						'reason'	=> 'Undecodable reCAPTCHA result',
						'reason_code'=> 203,
						'timestamp'	=> date('Y-m-d H:i:s')
					)));
				}
			}else{
				die(json_encode(array(
					'status'	=> 'fail',
					'reason'	=> 'Cannot communicate with Google',
					'reason_code'=> 204,
					'timestamp'	=> date('Y-m-d H:i:s')
				)));
			}
		}else{
			//use cache and pass for checking
			$useCache = true;
		}

		$q = $_POST['q'];
		$searchType = '';
		$searchValue = '';
		if($searchValue = filter_var($q, FILTER_VALIDATE_EMAIL)){
			$searchType = 'email';
		}else if(preg_match("/^[0-9]{0,15}$/u", $q) > 0){
			$searchType = 'phone';
			$searchValue = $q;
		}else if(preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $q) > 0){
			$searchType = 'phone';
			$searchValue = preg_replace("/[^0-9]/","", $q);
		}

		if(!empty($searchType) && !empty($searchValue)){
			try {
				$db = new PDO("mysql:host={$_setting['Host']};dbname={$_setting['Database']};charset=utf8", $_setting['Username'], $_setting['Password']);
			    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $stmt = $db->prepare("SELECT COUNT(`regis_id`) FROM camp_result WHERE {$searchType} = :queryData");
	    		$stmt->execute(array(':queryData' => $searchValue));
	    		$row = $stmt->fetch(PDO::FETCH_NUM);
	    		if($row[0] > 0){
	    			$stmt = $db->prepare("SELECT `regis_id` AS 'id', `name`, `nickname` FROM camp_result WHERE {$searchType} = :queryData");
					$stmt->execute(array(':queryData' => $searchValue));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					die(json_encode(array(
						'status'	=> 'success',
						'type'		=> $searchType,
						'keyword'	=> $searchValue,
						'result'	=> true,
						'userdata'	=> $row,
						'cache-reCAPTCHA'	=> $useCache,
						'timestamp'	=> date('Y-m-d H:i:s')
					)));
	    		}else{
	    			die(json_encode(array(
						'status'	=> 'success',
						'type'		=> $searchType,
						'keyword'	=> $searchValue,
						'result'	=> false,
						'cache-reCAPTCHA'	=> $useCache,
						'timestamp'	=> date('Y-m-d H:i:s')
					)));
	    		}
			} catch(PDOException $e) {
				die(json_encode(array(
					'status'	=> 'fail',
					'reason'	=> 'Error while querying : '.$e->getMessage(),
					'reason_code'=> 301,
					'timestamp'	=> date('Y-m-d H:i:s')
				)));
			}

		}else{
			die(json_encode(array(
				'status'	=> 'fail',
				'reason'	=> 'No Pattern match found',
				'reason_code'=> 302,
				'timestamp'	=> date('Y-m-d H:i:s')
			)));
		}
	}else{
		die(json_encode(array(
			'status'	=> 'fail',
			'reason'	=> 'No reCAPTCHA submitted',
			'reason_code'=> 102,
			'timestamp'	=> date('Y-m-d H:i:s')
		)));
	}
	//$statement = $db->prepare("select id from some_table where name = :name");
	//$statement->execute(array(':name' => "Jimbo"));
	//$row = $statement->fetch(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
