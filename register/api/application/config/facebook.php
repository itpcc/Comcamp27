<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$config['facebook']['api_id'] = 'YOUR_API_KEY';
	$config['facebook']['app_secret'] = 'YOUR_SECRET_KEY';
	$config['facebook']['redirect_url'] = '/';
	$config['facebook']['permissions'] = array(
		'email',
		'user_birthday'
	);

/* End of file facebook.php */
/* Location: ./application/config/facebook.php */