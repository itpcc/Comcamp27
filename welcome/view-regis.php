<?php
	if(isset($_GET['file'])){
		$filePath = './freestyle/'.basename($_GET['file']).'*';
		$result = glob($filePath);
		if(isset($result[0]))
			header("Location: {$result[0]}");
	}