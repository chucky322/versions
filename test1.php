<?php

//это от постмана
	$curl = curl_init();

	curl_setopt_array
	($curl, 
		array
		(
			CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/get_release_versions",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "<get_release_versions>\r\n    <parameters>\r\n        <!--Optional:-->\r\n        <REQUEST_TYPE>ALL</REQUEST_TYPE>\r\n        <!--Optional:-->\r\n        <RELEASE_VER_ID></RELEASE_VER_ID>\r\n        <!--Optional:-->\r\n        <RELEASE_TYPE1_ID></RELEASE_TYPE1_ID>\r\n    </parameters>\r\n</get_release_versions>",
			CURLOPT_HTTPHEADER => 
			array
			(
				"accept: application/xml",
				"cache-control: no-cache",
				"content-type: application/xml",
				"postman-token: d558095c-ee73-3442-7fe4-5796a113c3db",
				"user-agent: Jakarta Commons-HttpClient/3.1"
			),
		)
	);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	$xmlObject = simplexml_load_string($response);
	curl_close($curl);
	
	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	
	
	
	else 
	{
	
	$array = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0];

	foreach($array as $key => $item){
		
			echo  $item;
		
			
	}
	}
?>		