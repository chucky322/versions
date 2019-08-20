<?php
$RELEASE_VER_ID =$_POST['RELEASE_VER_ID'];

$curl = curl_init();

curl_setopt_array($curl, array
(
	CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/delete_release_version",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "<delete_release_version>\n\t<parameters>\n\t\t<REQUEST_TYPE>DELETE_RELEASE_VERSION</REQUEST_TYPE>\n\t\t<RELEASE_VER_ID>".$RELEASE_VER_ID."</RELEASE_VER_ID>\n\t</parameters>\n</delete_release_version>",
	CURLOPT_HTTPHEADER => array
	(
		"accept: application/xml",
		"cache-control: no-cache",
		"content-type: application/xml",
		"user-agent: Jakarta Commons-HttpClient/3.1"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) 
{
	echo "cURL Error #:" . $err;
} else 
{
	$doc = new DOMDocument;
	$doc->loadXML($response);

	$check_result_code=$doc->getElementsByTagName('RESULT_CODE')->item(0)->nodeValue;
	echo json_encode($check_result_code);
}
?>