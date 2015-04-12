<?php
	$jokeList = glob('./jokes/*.txt');

	if(($cnt = count($jokeList)) > 0){
		//if(isset($_GET['debug'])) var_dump($jokeList, $jokeList[time() % $cnt]);
		echo json_encode(array(
			'status'	=> 'success',
			'text'		=> file($jokeList[rand(0, $cnt-1)]),
			// 'text'		=> file($jokeList[time() % $cnt]),
			// 'text'		=> file($jokeList[0]),
			'timestamp'	=> date('Y-m-d H:i:s')
		));
	}else{
		die(json_encode(array(
			'status'	=> 'fail',
			'reason'	=> 'No Joke found',
			'timestamp'	=> date('Y-m-d H:i:s')
		)));
	}