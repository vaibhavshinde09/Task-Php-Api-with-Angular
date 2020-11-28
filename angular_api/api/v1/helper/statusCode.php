<?php
 
	function getComplaintStatus($code){

		$statusArray = [
			0 => 'New',
			1 => 'Pending',
			2 => 'Closed',
			3 => 'Cant Solved'
		];

		return (object)[
			"Complaint_status"=>$code,
			"Complaint_message"=>$statusArray[$code]
		];

	}

	function getResponseStatusMessages($code,$customMessage="",$data=null){
 
		 $statusArray = [
          				200=> 'Success',
				201=> 'Created',
				202=> 'Accepted',
				203=> 'Non-Authoritative Information',
				204=> 'No Content',
				207=> 'Multi-Status',
				208=> 'Already Reported',
				302=> 'Found',
				303=> 'See Other',
				304=> 'Not Modified',
				400=> 'Bad Request',
				401=> 'Unauthorized',
				402=> 'Payment Required',
				403=> 'Forbidden',
				404=> 'Not Found',
				405=> 'Method Not Allowed (Please make sure you request headers are Authorized)',
				406=> 'Not Acceptable',
				429=> 'Too Many Requests',
				431=> 'Request Header Fields Too Large',
				500=> 'Internal Server Error',
				502=> 'Bad Gateway',
				504=> 'Gateway Timeout',
				508=> 'Loop Detected',
				];
			
		$respObj= (object) [
         			"statusCode"=>$code,
			"statusMessage"=>$customMessage=="" ? $statusArray[$code]:$customMessage,
		];

		if($data!==null){
			$respObj->respData = $data;
		}
		return $respObj;
	}
?>