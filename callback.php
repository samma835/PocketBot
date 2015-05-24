<?php
	require_once('config.php');

	$request_token = $_GET['request_token'];

	$url = 'https://getpocket.com/v3/oauth/authorize';
	$data = array(
		'consumer_key' => $consumer_key, 
		'code' => $request_token
	);
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	$access_token = explode('&',$result);
	
	if($access_token[0]!=''){
		echo "Access token: ". $access_token[0];
		echo "<br>";
		echo "Put it into config.php";
	} else{
		echo "Error.";
	}

?>