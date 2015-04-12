<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require Library
// Keep it Auto or setup it as "files","sqlite","wincache" ,"apc","memcache","memcached", "xcache"
require_once("../phpfastcache.php");
phpFastCache::setup("storage","auto");
// phpFastCache::setup("storage","files");
// OR open phpfastcache.php and edit your config value there

function ip_address(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return $_SERVER['HTTP_CLIENT_IP'];
	}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		return $_SERVER['REMOTE_ADDR'];
	}
}
if(isset($_POST['response']) && isset($_POST['eieinaja']) && $_POST['eieinaja'] == 'comcampRecaptcha'){
	$cache = phpFastCache();
	$cache->set(hash('sha256', "Google : {$_POST['response']}"), time(), 10*60);
	echo $_POST['response'], ' : ', time();
}else{
	echo '-3-';
}
//var_dump($_POST);