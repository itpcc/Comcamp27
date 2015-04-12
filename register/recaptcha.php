<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
	$html = 'boom';
	$siteKey = '6Lf-ggETAAAAAH2JT2Z0t5klW22lThtlRxVENIKL';
	$secretKey = '6Lf-ggETAAAAAOtS9SBQI_t8Xp-T9coCJLRclL0g';
	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
		if($googleTxt = file_get_contents('https://www.google.com/recaptcha/api/siteverify?'.http_build_query(array(
			'secret'	=> $secretKey,
			'response'	=> $_POST['g-recaptcha-response']
			)))){
			if($result = json_decode($googleTxt, true)){
				if(isset($result['success']) && $result['success']){
					$html = "success";
				}else{
					$html = "fail";
				}
			}else{
				$html = "fail";
			}
		}else{
			$html = "fail";
		}
	}

	echo $html;
?>
