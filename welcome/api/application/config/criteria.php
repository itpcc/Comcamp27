<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['phone'] = "/\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}/";

$config['allow_field'] = array(
	'name'		=> 'string',
	'sirname'	=> 'string',
	'nickname'	=> 'string',
	'email'		=> 'string',
	'tel'		=> 'tel',
	'birth'		=> 'birth',
	'diase'		=> 'string',
	'food'		=> 'string',
	'travel'	=> 'number',
	'religion'	=> 'number',
	'parent'	=> 'string',
	'parent_name'	=> 'string',
	'parent_relation'	=> 'string',
	'parent_phone'	=> 'tel'
);

$config['uploadOption'] = array(
	'upload_path'	=> FCPATH.'/picture/',
	'allowed_types'	=> 'gif|jpg|png',
	'file_ext_tolower'	=> true,
	'overwrite'		=> true,
	'inputName'		=> 'figure'
	);