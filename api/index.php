<?php

header("content-type:application/json");
header("Access-Control-Allow-Method:GET");
header("Access-Control-Allow-Origin:*");

// validate request 

	if (isset($_GET['slack_name']) && $_GET['slack_name'] !== "" && isset($_GET['track']) && $_GET['track'] !== "") {
		response($_GET['slack_name'], $_GET['track'], 200);	
	}else{
		response(NULL, NULL, 400);
	}

// response message 
	
function response($slack_name, $track, $response_code) 
{
	$response;
	$date = date('y-m-d');
	 $dayOfWeek = date('l', strtotime($date));

	if ($response_code === 200) {
		$response['slack_name'] = $slack_name;
		$response['current_day'] = $dayOfWeek;
		// $response['utc_time'] =  date("Y-m-d H:i:s", time());
		$response['utc_time'] =  gmdate("Y-m-d\TH:i:s\Z");
		$response['track'] =  $track;
		$response['github_file_url'] =  "https://github.com/GoodnewsPerfect/HNGx-task1/blob/main/api/index.php";
		$response['github_repo_url'] =  "https://github.com/GoodnewsPerfect/HNGx-task1";
		$response['status_code'] =  $response_code;
	
	} else{
		$response['status_code'] =  $response_code;
		
	}

	$json_response = json_encode($response);
	echo $json_response;
	return $json_response;
}


?>