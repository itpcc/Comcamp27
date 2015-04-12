<?php
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	if (($handle = fopen("ccresult.csv", "r")) !== FALSE) {
		$allRows = array();
		$phoneArray = $phoneIndex = array();
		$i = 0;
		$mysqli = new mysqli('localhost', 'comcamp_result', 'A6L7Fhqrq', 'comcamp_27');
		$mysqli->query("SET character_set_results=utf8");
		$mysqli->query("SET character_set_client=utf8");
		$mysqli->query("SET character_set_connection=utf8");
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	    	$data[1] = sprintf("'%s'", $mysqli->real_escape_string($data[1]));
	    	$data[2] = sprintf("'%s'", $mysqli->real_escape_string($data[2]));
	    	$data[4] = sprintf("%010d", $data[4]);
	    	$data[5] = "'".date('Y-m-d H:i:s')."'";
	    	if(!empty($data[4]) && $data[4] > 0){
	    		$allRows[$i] = $data;
	    		$phoneIndex[$data[4]] = $i;	    	
	    		$phoneArray[$i] = "'{$data[4]}'";
	    		$i++;
	    	}
	    	
	    }
	    
	    //echo "SELECT mobile_phone, email FROM registration_data WHERE mobile_phone IN(".implode(",", $phoneArray).')', PHP_EOL, PHP_EOL;

	    $result = $mysqli->query("SELECT mobile_phone, email FROM registration_data WHERE mobile_phone IN(".implode(",", $phoneArray).')');
	    while($row = $result->fetch_assoc()){
	    	$allRows[$phoneIndex[$row['mobile_phone']]][3] = sprintf("'%s'", $mysqli->real_escape_string($row['email']));
	    }
	    
	    unset($phoneArray, $phoneIndex);
	    $rowValue = array();
	    foreach ($allRows as $i => $row){
	    	//var_dump($row);
	    	if(empty($row[3]))
	    		$row[3] = "''";
	    	$row[4] = "'{$row[4]}'";
	    	$rowValue[] = implode(', ', $row);
	    }
	    $sql = 'INSERT INTO `comcamp_27`.`camp_result` (`regis_id`, `name`, `nickname`, `email`, `phone`, `edited`) VALUES ('.implode("),\n (", $rowValue).')';
	    echo $sql, ';';
	    fclose($handle);
	}