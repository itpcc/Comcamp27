<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['user'] = array();
$config['user']['must_have'] = array(
	'fb_id',
	'fname_th',
	'lname_th',
	'nname_th',
	'fname_en',
	'lname_en',
	'nname_en',
	'birthdate',
	'age',
	'gender',
	'religion',
	'shirt_size',
	/*'congenital_disease',
	'food',*/
	'class_step',
	'class_type',
	'grade',
	'school',
	'school_province',
	'home_address',
	'home_village',
	'home_postal',
	'mobile_phone',
	'email',
	'parent_name',
	'parent_relation',
	'parent_address',
	'parent_village',
	'parent_postal',
	'parent_phone',
	/*'computer_reward',*/
	'travel',
	/* Complex type */
	'interest_universities'
	);
$config['user']['main_table'] = array(
	'fb_id',
	'fname_th',
	'lname_th',
	'nname_th',
	'fname_en',
	'lname_en',
	'nname_en',
	'birthdate',
	'age',
	'gender',
	'religion',
	'shirt_size',
	'congenital_disease',
	'food',
	'class_step',
	'class_type',
	'grade',
	'school',
	'school_province',
	'home_address',
	'home_village',
	'home_postal',
	'mobile_phone',
	'email',
	'parent_name',
	'parent_relation',
	'parent_address',
	'parent_village',
	'parent_postal',
	'parent_phone',
	'computer_reward',
	'travel',
	);
$config['user']['optional'] = array(
	'computer_skill_other',
	'skill'
	);
$config['user']['register_criteria'] = array();
$config['user']['register_criteria']['token'] 		= array( 'regex' => "/^(?!0x)[a-zA-Z1-9][a-zA-Z0-9]{1,129}$/ui");
$config['user']['register_criteria']['fname_th'] 	= array( 'regex' => "/^[ก-๙เค\\.]{1,100}$/u");
$config['user']['register_criteria']['lname_th'] 	= array( 'regex' => "/^[ก-๙เค]{1,100}$/u");
$config['user']['register_criteria']['nname_th'] 	= array( 'regex' => "/^[ก-๙เค\\.]{1,50}$/u");
$config['user']['register_criteria']['fname_en'] 	= array( 'regex' => "/^[a-zA-Z\\.]{1,100}$/u");
$config['user']['register_criteria']['lname_en'] 	= array( 'regex' => "/^[a-zA-Z\\.]{1,100}$/u");
$config['user']['register_criteria']['nname_en'] 	= array( 'regex' => "/^[a-zA-Z\\.]{1,50}$/u");
$config['user']['register_criteria']['birthdate'] 	= array( 'regex' => "/^(0?[1-9]|[12][0-9]|3[01])[- \\/.]((0?[1-9]|1[012])[- \\/.](19|20)?[0-9]{2})*$/u");
$config['user']['register_criteria']['age'] 		= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['gender'] 		= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['religion'] 	= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['shirt_size'] 	= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['congenital_disease']	= array( 'regex' => "/^(?!0x)[a-zA-Z1-9][a-zA-Z0-9,\\ \\.]{1,99}$/ui");
$config['user']['register_criteria']['food'] 		= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค,\\ \\.]{1,99}$/ui");
$config['user']['register_criteria']['class_step'] 	= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['class_type'] 	= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['grade'] 		= array( 'regex' => "/^[0-4]\\.[0-9]{0,2}$/u", 'filter'=>FILTER_VALIDATE_FLOAT);
$config['user']['register_criteria']['school'] 		= array( 'regex' => "/^[1-9][0-9]{0,9}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['school_province']		= array( 'regex' => "/^[1-9][0-9]{0,3}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['home_address'] 		= array(
	'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\\/\\ \\.]{1,199}$/ui");
$config['user']['register_criteria']['home_village'] 		= array( 'regex' => "/^[1-9][0-9]{0,8}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['home_postal']	= array( 'regex' => "/^[1-9][0-9]{0,5}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['mobile_phone'] 		= array( 'regex' => "/^[0-9]{0,15}$/u");
$config['user']['register_criteria']['email'] 		= array( 'regex' => '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/uiD', 'filter'=>FILTER_VALIDATE_EMAIL);
$config['user']['register_criteria']['parent_name']	= array( 'regex' => "/^[ก-๙เค][ก-๙เค\\ \\.]{1,199}$/u");
$config['user']['register_criteria']['parent_relation']		= array( 'regex' => "/^[ก-๙เค]{1,50}$/u");
$config['user']['register_criteria']['parent_address']		= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\\/\\ \\.]{1,199}$/ui");
$config['user']['register_criteria']['parent_village'] 		= array( 'regex' => "/^[1-9][0-9]{0,8}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['parent_postal'] 		= array( 'regex' => "/^[1-9][0-9]{0,5}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['parent_phone'] 		= array( 'regex' => "/^[0-9]{0,15}$/u");
$config['user']['register_criteria']['computer_reward'] 	= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\\/\\ \\.]{1,199}$/u");
$config['user']['register_criteria']['computer_skill_other'] = array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\\/\\ ]{1,99}$/ui");
$config['user']['register_criteria']['travel']		= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['registration_type'] 	= array( 'regex' => "/^[1-9][0-9]{0,2}$/u", 'filter'	=> FILTER_VALIDATE_INT);
$config['user']['register_criteria']['camp']['camp_name']	= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\/\\ \\.#]{1,199}$/ui");
$config['user']['register_criteria']['camp']['camp_by']		= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\,\\/\\ \\.]{1,199}$/ui");
$config['user']['register_criteria']['interest_universities']['university']	= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙เค][a-zA-Z0-9ก-๙เค\\-\\ ]{1,99}$/ui");
$config['user']['register_criteria']['interest_universities']['faculty']	= array( 'regex' => "/^(?!0x)[a-zA-Z1-9ก-๙\\เ\\ค][a-zA-Z0-9ก-๙\\เ\\ค\\-\\ \\(\\)]{1,99}$/ui");
