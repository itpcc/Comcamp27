<?php
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	if (($handle = fopen("regis.csv", "r")) !== FALSE) {
		$allRows = array();
		$phoneArray = $phoneIndex = array();
		$i = 0;
		$mysqli = new mysqli('localhost', 'comcamp_result', 'A6L7Fhqrq', 'comcamp_27');
		$mysqli->query("SET character_set_results=utf8");
		$mysqli->query("SET character_set_client=utf8");
		$mysqli->query("SET character_set_connection=utf8");
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
	    	if($i > 0){
	    		if(empty($data[0]))
	    			$data[0] = $i+57100;
		    	$data[1] = "'".$mysqli->real_escape_string($data[1])."'";
		    	$data[2] = "'".$mysqli->real_escape_string($data[2])."'";
		    	$data[3] = "'".$mysqli->real_escape_string($data[3])."'";
		    	$data[4] = "'".$mysqli->real_escape_string($data[4])."'";
		    	$data[5] = "'".$mysqli->real_escape_string($data[5])."'";
		    	if(!empty($data[6])){
			    	$date = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data[6]));
			    	//var_dump($i, $data[6], $date);
			    	$data[6] = "'".($date->format('Y-m-d'))."'";
			    }else{
			    	$data[6] = "''";
			    }
		    	$data[7] = "'".$mysqli->real_escape_string($data[7])."'";
		    	$data[8] = "'".$mysqli->real_escape_string($data[8])."'";
		    	$data[9] = "'".$mysqli->real_escape_string($data[9])."'";
		    	$data[10] = "'".$mysqli->real_escape_string($data[10])."'";
		    	$data[11] = "'".$mysqli->real_escape_string($data[11])."'";
		    	$data[12] = "'".$mysqli->real_escape_string($data[12])."'";
		    	$data[13] = "'".$mysqli->real_escape_string($data[13])."'";
		    	$data[14] = "'".$mysqli->real_escape_string($data[14])."'";
		    	$data[15] = "'".$mysqli->real_escape_string($data[15])."'";
		    	$data[16] = "''";
		    	$data[17] = "0";
		    	$data[18] = "CURRENT_TIMESTAMP";
				$allRows[$i] = $data;
			}
			$i++;
	    }

	    foreach ($allRows as $i => $row){

	    	$rowValue[] = implode(', ', $row);
	    }
	    $sql = 'INSERT INTO `comcamp_testflight`.`regis_data` (`id`, `name`, `sirname`, `nickname`, `email`, `tel`, `birth`, `diase`, `food`, `eat`, `religion`, `travel`, `section`, `parent_name`, `parent_phone`, `parent_relation`, `upload`, `registered`, `edited`) VALUES  ('.implode("),\n (", $rowValue).')';
	    echo $sql, ';';
	    fclose($handle);
	}