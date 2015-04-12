<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Login for Server-side Apps.
 *
 * @author Xavier Barbosa
 * @since 13 February, 2013
 * @link https://developers.facebook.com/docs/howtos/login/server-side-re-auth/
 **/
/*require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../src/Mute/Facebook/App.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../src/Mute/Facebook/Bases/AccessToken.php';*/
require './autoload.php';
use Mute\Facebook\App;
use Mute\Facebook\Exception\GraphAPIException;

/**
 * Default params
 **/

$app_id = "478731965498089";
$app_secret = "7ec2304046e8844f8ada3753205ea793";
$my_url = "http://www.comcamp.in.th/pilot/mute/example/server-side-login.php";

session_start();

echo '<h2>Server result : </h2>';

function default_exception_handler(Exception $e){
    // show something to the user letting them know we fell down
    echo "<h2>Something Bad Happened</h2>";
    echo "<p>",  $e->getMessage(), "</p>";
    // do some logging for the exception and call the kill_programmer function.
 }
//set_exception_handler("default_exception_handler");

/**
 * The process
 **/

$app = new App($app_id, $app_secret);


$code = isset($_REQUEST["code"])?$_REQUEST["code"]:'';

if (empty($code)) {
    $_SESSION['state'] = md5(uniqid(rand(), true));
    $_SESSION['nonce'] = md5(uniqid(rand(), TRUE)); // New code to generate auth_nonce
    $dialog_url = $app->getOAuth()->getCodeURL($my_url, array('user_birthday', 'read_stream'), $_SESSION['state']);

    echo 'URL :', json_encode($dialog_url);
    //echo "<script> top.location.href=" . json_encode($dialog_url) . "</script>";
    die;
}

if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
    $OAuth = $app->getOAuth();
    /*$params = $OAuth->getAccessToken($code, $my_url);
    $_SESSION['access_token'] = $params['access_token'];*/

    try{
        $user = $app->get('me', array(
            'access_token' => $code,  
        ));
    }catch(Exception $e){
        $user['error'] = $e->getMessage();
        var_dump($e->getData());
        //return array('error'=>'Graph error:');
    }
    
    //var_dump($user);
    if(!empty($user['error'])){
        $_SESSION['state'] = md5(uniqid(rand(), true));
        $_SESSION['nonce'] = md5(uniqid(rand(), TRUE)); // New code to generate auth_nonce
        $dialog_url = $app->getOAuth()->getCodeURL($my_url, array('user_birthday', 'read_stream'), $_SESSION['state']);
        echo $user['error'], ' <br/> Re-Coding...', 'URL :', json_encode($dialog_url);
    }else{
        //var_dump($user);
        echo("{$user['id']} {$user['name']}");
        //$OAuth->exchangeAccessToken($code);
    }
}
else {
    echo("The state does not match. You may be a victim of CSRF.");
}
