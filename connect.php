<?php
	
	require_once('config.php');

	$url = 'https://getpocket.com/v3/oauth/request';
	$data = array(
		'consumer_key' => $consumer_key, 
		'redirect_uri' => $redirect_uri
	);
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	$code = explode('=',$result);
	$request_token = $code[1];
	
	header("Location: https://getpocket.com/auth/authorize?request_token=$request_token&redirect_uri=$redirect_uri?request_token=$request_token");

?>