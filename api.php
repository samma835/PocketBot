<?php
	error_reporting(E_ALL || ~E_NOTICE); 
	header("Content-Type: text/html; charset=UTF-8");
	require_once('config.php');
	
	// change your own tags here
	$tags = array('阅读', '创业', '工具', '资源', '视频');

	$data = array(
		'consumer_key' => $consumer_key, 
		'access_token' => $access_token
	);
	$options = array(
		'http' => array(
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	
	for ($i = 0; $i < count($tags); $i++) {
		echo '## ' . $tags[$i] . '<br/>' . '<br/>';
		$url = 'https://getpocket.com/v3/get?detailType=simple&tag=' . $tags[$i];
		$result = json_decode(file_get_contents($url, false, $context), true);
		foreach(array_values($result['list']) as $item){
			echo($item['resolved_title'] . '<br/>');
			echo('<a href="' . $item['resolved_url'] . '">' . $item['resolved_url'] . '</a>' . '<br/>' . '<br/>');
		}
	}
	


?>