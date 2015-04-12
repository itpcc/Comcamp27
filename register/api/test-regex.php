<?php
	$str = "คณะวิศวกรรมศาสตร์ (สาขาวิศวกรรมคอมพิวเตอร์)";
	var_dump($strNew = preg_replace('/\s+/', " ", preg_replace("/[\n\r\t\s+]/", " ", $str)));
	var_dump(preg_match("/^(?!0x)[a-zA-Z1-9ก-๙\\เ\\ค][a-zA-Z0-9ก-๙\\เ\\ค\\-\\ \\(\\)]{1,99}$/ui", $str));
	var_dump(preg_match("/^(?!0x)[a-zA-Z1-9ก-๙\\เ\\ค][a-zA-Z0-9ก-๙\\เ\\ค\\-\\ \\(\\)]{1,99}$/ui", $strNew));