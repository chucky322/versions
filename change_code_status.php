<?php
session_start();
$RELEASE_VER_ID =$_POST['RELEASE_VER_ID'];
$REQUEST_TYPE =$_POST['REQUEST_TYPE'];
$ACTION_USER=$_SESSION['username'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/change_code_status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<change_code_status>\n\t<parameters>\n\t\t<REQUEST_TYPE>".$REQUEST_TYPE."</REQUEST_TYPE>\n\t\t<RELEASE_VER_ID>".$RELEASE_VER_ID."</RELEASE_VER_ID>\n\t\t<ACTION_USER>".$ACTION_USER."</ACTION_USER>\n\t</parameters>\n</change_code_status>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: 484666ca-d865-ba03-3075-bbb606abc0a6",
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