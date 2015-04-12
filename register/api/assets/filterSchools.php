<?php
    $mysqli = new mysqli('localhost', 'root', '', 'comcamp');
    $mysqli->query("SET character_set_results=utf8");
	$mysqli->query("SET character_set_client=utf8");
	$mysqli->query("SET character_set_connection=utf8");
    $queryResult = $mysqli->query("SELECT `PROVINCE_ID`,`PROVINCE_NAME` FROM `address_province`");
    $provinces = array();
    while($row = $queryResult->fetch_assoc()){
    	$provinces[preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $row['PROVINCE_NAME'])] = $row['PROVINCE_ID'];
    }

    $i = 0;

    var_dump($provinces);

    flush();

    $schools = array(
    	'mathayoms' => array(),
    	'universities' => array()
    	);
    $file = fopen('D:\web\htdocs\comcamp\api\assets\educations.csv', 'r');
	while (($line = fgetcsv($file)) !== FALSE) {
		if(++$i > 2){
			if(!empty($line[37]) || !empty($line[38])){
				$schoolProvince =  preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[4]);
				$schools['mathayoms'][] = array(
					'code'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[1]),
					'name'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[2]),
					'province' => isset($provinces[$schoolProvince])?$provinces[$schoolProvince]:"---NOTFOUND--{$schoolProvince}"
					);
			}else if(!empty($line[63]) || !empty($line[64])){
				$schoolProvince =  preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[4]);
				$schools['universities'][] = array(
					'code'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[1]),
					'name'	=> preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u','', $line[2]),
					'province' => isset($provinces[$schoolProvince])?$provinces[$schoolProvince]:"---NOTFOUND--{$schoolProvince}"
					);
			}
		}
	}
	fclose($file);
	var_dump($schools);
	file_put_contents('D:\web\htdocs\comcamp\api\assets\result.php', var_export($schools, true));