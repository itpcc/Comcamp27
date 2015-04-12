<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	// The path to the FTP file, including login arguments
	$ftp_path = 'ftp://ftp_register:sbeuxEXqG@comcamp.in.th/';

	// Allows overwriting of existing files on the remote FTP server
	$stream_options = array('ftp' => array('overwrite' => true));

	// Creates a stream context resource with the defined options
	var_dump($stream_context = stream_context_create($stream_options));

	if($dirResource = rename('/home/comcamp/domains/comcamp.in.th/public_html/register/b.txt', '/home/comcamp/domains/comcamp.in.th/public_html/register/api/docs/b.txt', $stream_context)){
		var_dump($dirResource);
	}else{
		echo 'error move file';
	}

