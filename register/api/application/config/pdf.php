<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	$config['pdf_path']	= '/home/comcamp/domains/comcamp.in.th/register_pdf/';
	$config['pdf_template']	= '/home/comcamp/domains/comcamp.in.th/public_html/register/api/assets/v01.pdf';
	$config['printData'] = array(
		1 => array(
			/*array("id", array(180, 12), "%06d", array(255, 255, 255, 16, 1)),*/
			array("condition", array(30, 62), "%s", array(255, 255, 255, 7, 1.4)),
			array("name_th", array(35.5, 95)),
			array("sirname_th", array(112, 95)),
			array("name_en", array(40.5, 103)),
			array("sirname_en", array(112, 103)),
			array("nickname_th", array(40.5, 112)),
			array("nickname_en", array(114, 112)),
			array("birth_day", array(56, 120.5)), //+6.5
			array("birth_month", array(67, 120.5)),
			array("birth_year", array(94.5, 120.5), "%2d"),
			array("age", array(111, 120.5)),
			array("gender", array(135, 120.5)),
			array("religion", array(45, 129)),
			array("shirt_size", array(
				"S"		=> array( 81.00, 127,  81.00+3.5, 127+3.5),
				"M"		=> array( 93.00, 127,  93.00+3.5, 127+3.5),
				"L"		=> array(106.00, 127, 106.00+3.5, 127+3.5),
				"XL"	=> array(117.82, 127, 117.82+3.5, 127+3.5),
				"XXL"	=> array(132.25, 127, 132.25+3.5, 127+3.5)
				), false),
			array("congenital_disease", array(50, 137.5)),
			 //+6.25
			array("food", array(134.5, 137.75)),
			array("class_step", array(78.25, 157.25)), //+12.50
			array("class_type", array(108, 157.25)),
			array("grade_prefix", array(178, 157.25), "%01d."),
			array("grade_suffux", array(181.5, 157.25)),
			array("school", array(42.5, 165)), //+12.50
			array("school_province", array(130, 165)),
			array("home_address", array(30, 179.80, 63)), //+6.5
			array("mobile_phone_prefix", array(55, 201.5)),//+6.5
			array("mobile_phone_suffix", array(67, 201.5)),
			array("email", 				array(134  , 201.5)),
			array("parent_name", 		array( 35.5, 229.5)),//+6.5
			array("parent_relation", 	array(155  , 229.5)),
			array("parent_address", 	array( 30  , 233.5, 63)),//+6.5
			array("parent_phone_prefix", array( 91, 255.5)),//+6.5
			array("parent_phone_suffix", array(105, 255.5)),
		),
		2 => array(
			array("intuni_1_faculty", 		array(60   , 40)),
			array("intuni_1_university", 	array(145.5, 40)),
			array("intuni_2_faculty", 		array(60   , 48.5)),
			array("intuni_2_university", 	array(145.5, 48.5)),
			array("intuni_3_faculty", 		array(60   , 57)),
			array("intuni_3_university", 	array(145.5, 57)),
			array("camp_joined", array(
				"Y"		=> array(36.5, 71, 40, 74.5),
				"N"		=> array(85, 71, 88.75, 74.5)
			), false),
			array("camp_1_name", array(46, 81.5)), //+6.5
			array("camp_1_university", array(120, 81.5)),
			array("camp_1_year", array(175, 81.5)),
			array("camp_2_name", array(46, 90)), //+6.5
			array("camp_2_university", array(120, 90)),
			array("camp_2_year", array(175, 90)),
			array("camp_3_name", array(46, 98.5)), //+6.5
			array("camp_3_university", array(120, 98.5)),
			array("camp_3_year", array(175, 98.5)),
			array("computer_reward", array(
				"Y"		=> array(36.5, 113.5, 40, 117),
				"N"		=> array(85, 113.5, 88.75, 117)
			), false),
			array("computer_reward_detail", array(40, 119, 40), "%s"),//+6.5
			array("programming_practice", array(
				"Y"		=> array(35.85+1.25, 73.85+94.25, 39+1.25, 77.15+94.25)
			), false),
			array("programming_interest", array(
				"Y"		=> array(53.35+4.5, 73.85+94.25, 56.4+4.5, 77.15+94.25)
			), false),
			array("hardware_practice", array(
				"Y"		=> array(115.775+4.5, 73.85+94.25, 119.075+4.5, 77.15+94.25)
			), false),
			array("hardware_interest", array(
				"Y"		=> array(133.275+7.5, 73.85+94.25, 136.575+7.5, 77.15+94.25)
			), false),
			array("website_practice", array(
				"Y"		=> array(35.85+1.25, 83.5+93.25, 39+1.25, 86.8+93.25)
			), false),
			array("website_interest", array(
				"Y"		=> array(53.35+4.5, 83.5+93.25, 56.4+4.5, 86.8+93.25)
			), false),
			array("circuit_practice", array(
				"Y"		=> array(115.775+4.5, 83.5+93.25, 119.075+4.5, 86.8+93.25)
			), false),
			array("circuit_interest", array(
				"Y"		=> array(133.275+7.5, 83.5+93.25, 136.575+7.5, 86.8+93.25)
			), false),
			array("animation_practice", array(
				"Y"		=> array(35.85+1.25, 93.175+92, 39+1.25, 96.475+92)
			), false),
			array("animation_interest", array(
				"Y"		=> array(53.35+4.5, 93.175+92, 56.4+4.5, 96.475+92)
			), false),
			array("network_practice", array(
				"Y"		=> array(115.775+4.5, 93.175+92, 119.075+4.5, 96.475+92)
			), false),
			array("network_interest", array(
				"Y"		=> array(133.275+7.5, 93.175+92, 136.575+7.5, 96.475+92)
			), false),
			array("graphic_practice", array(
				"Y"		=> array(35.85+1.25, 99.5+94.25, 39+1.25, 102.8+94.25)
			), false),
			array("graphic_interest", array(
				"Y"		=> array(53.35+4.5, 99.5+94.25, 56.4+4.5, 102.8+94.25)
			), false),
			array("robot_practice", array(
				"Y"		=> array(115.775+4.5, 99.5+94.25, 119.075+4.5, 102.8+94.25)
			), false),
			array("robot_interest", array(
				"Y"		=> array(133.275+7.5, 99.5+94.25, 136.575+7.5, 102.8+94.25)
			), false),
			array("other_practice", array(
				"Y"		=> array(35.85+1.25, 106+96, 39+1.25, 109.3+96)
			), false),
			array("other_interest", array(
				"Y"		=> array(53.35+4.5, 106+96, 56.4+4.5, 109.3+96)
			), false),
			array("other_interest_detail", array(73.25+6.5, 108+94.25)),


			array("travel_victory", array(
				"Y"		=> array(35.125, 229.825, 35.125+3.5, 229.825+3.5)
			), false),
			array("travel_morchit2", array(
				"Y"		=> array(77.75, 229.825, 77.75+3.5, 229.825+3.5)
			), false),
			array("travel_hualampong", array(
				"Y"		=> array(142.75, 229.825, 142.75+3.5, 229.825+3.5)
			), false),
			array("travel_akamai", array(
				"Y"		=> array(35.125, 229.825+8.75, 35.125+3.5, 229.825+3.5+8.75)
			), false),
			array("travel_myself", array(
				"Y"		=> array(77.75, 229.825+8.75, 77.75+3.5, 229.825+3.5+8.75)
			), false)/*,

			array("get_result_phone", array(
				"Y"		=> array(30.625+1.875, 127.65+34.133, 33.925+1.875, 130.95+34.133)
			), false),
			array("get_result_line", array(
				"Y"		=> array(30.625+1.875, 134.125+34.850, 33.925+1.875, 137.425+34.850)
			), false),
			array("get_result_facebook", array(
				"Y"		=> array(30.625+1.875, 140.575+35.625, 33.925+1.875, 143.870+35.625)
			), false),
			array("get_result_phone_prefix", array(126.25, 163.825), "%3d"),
			array("get_result_phone_suffix", array(138.25, 163.825)),
			array("get_result_line_id", array(135.75, 170.550)),
			array("get_result_facebook_name", array(132.5, 178)),*/
		),
		3 => array(
			array("name_th", array(32.5, 281.5)),
			array("sirname_th", array(91.5, 281.5)),
			array("school", array(153.5, 276.75, 153.5), "%s", NULL, 'R'),
		),
		4 => array(
			array("name_th", array(32.5-5.5, 281.5-0.75)),
			array("sirname_th", array(91.5-5.5, 281.5-0.75)),
			array("school", array(153.5-5.5, 276.75-0.75, 153.5-5.5), "%s", NULL, 'R'),
		),
		5 => array(
			array("name_th", array(32.5, 281.5)),
			array("sirname_th", array(91.5, 281.5)),
			array("school", array(153.5, 276.75, 153.5), "%s", NULL, 'R'),
		),
		6 => array(
			array("name_th", array(32.5, 281.5+5.5)),
			array("sirname_th", array(91.5, 281.5+5.5)),
			array("school", array(153.5, 281.5+5.5)),
		),
		7 => array(
			array("name_th", array(32.5, 281.5)),
			array("sirname_th", array(91.5, 281.5)),
			array("school", array(153.5, 281.5)),
		),
		8 => array(
			array("name_th", array(32.5-7, 281.5-3)),
			array("sirname_th", array(91.5-7, 281.5-3)),
			array("school", array(153.5-7, 281.5-3)),
		),
		10 => array(
			array("name_th", array(32.5, 281.5-3.5)),
			array("sirname_th", array(91.5, 281.5-3.5)),
			array("school", array(153.5, 276.75-3.5, 153.5-1.5)),
		),
		11 => array(
			array("parent_name", array(
				"/^นางสาว/"		=> array(74.5+3 , 72.25-2.5, 6   , 2.75),
				"/^นาง/"			=> array(65+2.32, 72.25-2.25, 3.35, 2),
				"/^นาย/"			=> array(58+1.75   , 72.25-2.5, 3.25, 2)
			), true, true),
			array("parent_name", array(81+3, 72.25-4), "%s", NULL, 'L', "/^(นาย|นางสาว|นาง)/", ""),
			array("fullname", array(
				"/^นางสาว/"		=> array(74.5 + 35  , 78.50 + 0.5, 6   , 2.75),
				"/^นาย/"			=> array(58   + 41.5, 78.50      , 3.25, 2),
				"/^เด็กชาย/"		=> array(74.5 +  0.5, 78.50 + 0.5, 6   , 2.75),
				"/^เด็กหญิง/"		=> array(74.5 + 13.7, 78.50 + 0.5, 6.5 , 2.75)
			), true, true),
			array("fullname", array(118, 77.5), "%s", NULL, 'L', "/^(นาย|นางสาว|เด็กชาย|เด็กหญิง)/", ""),
			array("parent_relation", array(61.5, 86)),
			array("parent_name", array(144.5, 136.50 + 24), "%s", NULL , 'C')
		),
		16 => array(
			array("fullname", array(144.5, 182.50), "%s", NULL, 'C'),
		)
	);