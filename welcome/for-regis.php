<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
$_setting = array();
$_setting['Database']	=	'comcamp_27';
$_setting['Host']		=	'localhost';
$_setting['Username']	=	'comcamp_result';
$_setting['Password']	=	'A6L7Fhqrq';

require_once("./phpfastcache.php");
phpFastCache::setup("storage","auto");
echo '<meta charset="UTF-8">';
$cacheObj = phpFastCache();
$cacheName = md5(__FILE__).filemtime(__FILE__);
$cacheResult = $cacheObj->get($cacheName);
if($cacheResult == null){ //If appspot doesn't send data before, let do it by itself.
	$idWantStr = <<<ID
271010
271028
271030
271046
271056
271090
271104
271106
271109
271158
271173
271231
271258
271261
271269
271310
271318
271343
271344
271354
271381
271418
271424
271443
271456
271460
271462
271474
271475
271477
271479
271481
271498
271502
271518
271538
271542
271549
271555
271557
271561
271565
271570
ID;
	$idWant = array();
	foreach (explode(PHP_EOL, $idWantStr) as $id) {
		if(!empty($id)){
			$tmp = (int) substr(trim($id), 3);
			if($tmp > 0)
				$idWant[] = $tmp;
		}
	}
	$db = new PDO("mysql:host={$_setting['Host']};dbname={$_setting['Database']};charset=utf8", $_setting['Username'], $_setting['Password']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT registration_data.*, option_school.name AS 'school_name', option_travel.place AS 'travel_place', district1.DISTRICT_NAME AS 'home_district', amphur1.AMPHUR_NAME AS 'home_amphur', province1.PROVINCE_NAME AS 'home_province', district2.DISTRICT_NAME AS 'parent_district', amphur2.AMPHUR_NAME AS 'parent_amphur', province2.PROVINCE_NAME AS 'parent_province'  FROM `registration_data` INNER JOIN option_school ON option_school.schoolid = registration_data.school LEFT JOIN option_travel ON option_travel.id = registration_data.travel INNER JOIN address_district AS district1 ON registration_data.home_village = district1.DISTRICT_CODE INNER JOIN address_amphur AS amphur1 ON amphur1.AMPHUR_ID = district1.AMPHUR_ID  INNER JOIN address_province AS province1 ON province1.PROVINCE_ID = district1.PROVINCE_ID INNER JOIN address_district AS district2 ON registration_data.parent_village = district2.DISTRICT_CODE INNER JOIN address_amphur AS amphur2 ON amphur2.AMPHUR_ID = district2.AMPHUR_ID  INNER JOIN address_province AS province2 ON province2.PROVINCE_ID = district2.PROVINCE_ID WHERE registration_data.id IN (".implode(', ', $idWant).") ORDER BY `registration_data`.`id` ASC";
	$result = array();
	//echo $sql, '<br />';
	$sth = $db->prepare($sql);
	$sth->execute();

	while ($row = $sth->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
		if($row['travel_place'] == null)
			$row['travel_place'] = $row['travel'];

		$result[$row['id']] = $row;
		$lastRow = $row['id'];
	}

	$sql = "SELECT userid, file, location FROM `registration_upload` WHERE file IN (9, 8) AND userid IN (".implode(', ', $idWant).") ORDER BY `registration_upload`.`id` ASC";
	$sth = $db->prepare($sql);
	$sth->execute();
	while ($row = $sth->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
		if(!isset($result[$row['userid']]['image']))
			$result[$row['userid']] = array('image' => $row['location']) + $result[$row['userid']];
		else if($row['file'] == 9)
			$result[$row['userid']]['image'] = $row['location'];
	}

	$stmt = null;

	//Final
	$cacheResult = time().'<table><thead><tr><th>'.implode('</th><th>', array_keys($result[$lastRow])).'</th></tr></thead><tbody>';
	foreach ($result as $id => $row) {
		if(!isset($row['image']))
			$row = array('image' => '-') + $row;
		else
			$row['image'] = "<a href=\"view-regis.php?file=".urlencode($row['image'])."\" target=\"_blank\">{$row['image']}</a>";
		$cacheResult .= '<tr><td style="border: solid 1px black;">'.implode('</td><td style="border: solid 1px black;">', $row).'</td></tr>';
	}
	$cacheResult .= '</tbody></table>';
	$cacheObj->set($cacheName, $cacheResult, 10*60);
}
echo $cacheResult, '<br/> hhh';
