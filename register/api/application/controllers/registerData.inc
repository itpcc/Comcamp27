<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$birthDate = strtotime($userData['birthdate']);
$registerData = array(
	"id"					=> sprintf("271%03d", $userData['id']),
	"condition"				=> "* ใบสมัครนี้เป็นใบสมัครที่ออกโดยระบบอัตโนมัติ ไม่สามารถถ่ายเอกสารได้",
	"name_th"				=> $userData['fname_th'],
	"sirname_th"			=> $userData['lname_th'],
	"fullname"				=> sprintf("%s %s", $userData['fname_th'], $userData['lname_th']),
	"name_en"				=> $userData['fname_en'],
	"sirname_en"			=> $userData['lname_en'],
	"nickname_th"			=> $userData['nname_th'],
	"nickname_en"			=> $userData['nname_en'],
	"birth_day"				=> date('j', $birthDate),
	"birth_month"			=> generate_date_today("F", $birthDate, "th", false),
	"birth_year"			=> substr((string)(((int) date("Y", $birthDate)) + 543), -2),
	"age"					=> floor((time() - $birthDate) / 31556926),
	"gender"				=> (($userData['gender'] == 1)?'ชาย':'หญิง'),
	"religion"				=> $userData['religion'],
	"shirt_size"			=> $userData['size'],
	"congenital_disease"	=> $userData['congenital_disease'],
	"food"					=> $userData['food'],
	"class_step"			=> $userData['class_step'],
	"class_type"			=> $userData['class_type'],
	"grade_prefix"			=> floor($userData['grade']),
	"grade_suffux"			=> substr((string) floor($userData['grade'] * 100), -2),
	"school"				=> $userData['school']['school'],
	"school_province"		=> $userData['school']['province'],
	"home_address"			=> sprintf(
		"%s %s %s %s %05d", 
		$userData['home_address'], 
		$userData['home_village']['district'], 
		$userData['home_village']['amphur'], 
		$userData['home_village']['province'], 
		$userData['home_village']['zipcode'] 
	),
	"mobile_phone_prefix"	=> substr($userData['mobile_phone'], 0, 3),
	"mobile_phone_suffix"	=> substr($userData['mobile_phone'], 3),
	"email"					=> $userData['email'],
	"parent_name"			=> $userData['parent_name'],
	"parent_relation"		=> $userData['parent_relation'],
	"parent_address"		=> sprintf(
		"%s %s %s %s %05d", 
		$userData['parent_address'], 
		$userData['parent_village']['district'], 
		$userData['parent_village']['amphur'], 
		$userData['parent_village']['province'], 
		$userData['parent_village']['zipcode'] 
	),
	"parent_phone_prefix"	=> substr($userData['parent_phone'], 0, 3),
	"parent_phone_suffix"	=> substr($userData['parent_phone'], 3),
	);

if(isset($userData['interest_universities']) && !empty($userData['interest_universities'])){
	foreach ($userData['interest_universities'] as $id => $intuni) {
		$id++;
		$registerData["intuni_{$id}_faculty"] = $intuni['faculty'];
		$registerData["intuni_{$id}_university"] = $intuni['university'];
	}
}

if(isset($userData['camp_joined']) && !empty($userData['camp_joined'])){
	$registerData["camp_joined"] = 'Y';
	foreach ($userData['camp_joined'] as $id => $camp) {
		$id++;
		$registerData["camp_{$id}_name"] = $camp['name'];
		$registerData["camp_{$id}_university"] = $camp['university'];
	}
}else{
	$registerData["camp_joined"] = 'N';
}

if(isset($userData['computer_reward']) && !empty($userData['computer_reward'])){
	$registerData['computer_reward'] = 'Y';
	$registerData['computer_reward_detail'] = $userData['computer_reward'];
}else{
	$registerData['computer_reward'] = 'N';
}

if(isset($userData['skill']['interest']) && !empty($userData['skill']['interest'])){
	foreach ($userData['skill']['interest'] as $interest) {
		$id++;
		$registerData["{$interest['alias']}_interest"] = 'Y';
	}
}

if(isset($userData['skill']['practice']) && !empty($userData['skill']['practice'])){
	foreach ($userData['skill']['practice'] as $practice) {
		$id++;
		$registerData["{$practice['alias']}_practice"] = 'Y';
	}
}

if(isset($userData['computer_skill_other']) && !empty($userData['computer_skill_other'])){
	$registerData["other_interest"] = 
		$registerData["other_practice"] = 
		'Y';
	$registerData["other_interest_detail"] = str_replace("\n", ' ', $userData['computer_skill_other']);
}

if(isset($userData['travel_alias']) && !empty($userData['travel_alias']))
	$registerData["travel_{$userData['travel_alias']}"] = 'Y';
else
	$registerData['travel_myself'] = 'Y';