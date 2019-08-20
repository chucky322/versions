<?php
session_start();
$RELEASE_VER_ID =$_POST['CHANGE_RELEASE_VER_ID'];
$CODE_NAME =$_POST['CHANGE_NAME_STATUS'];
$ACTION_USER=$_SESSION['username'];
$TEXT_COMMENT=$_POST['CHANGE_TEXT_COMMENT'];
$DICT_VER_ID=$_POST['CHANGE_DICT_VER_ID'];
$EVENT_NAME=$_POST['CHANGE_EVENT_NAME'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/update_release_versions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpUpdate_Release_ver>\n\t<parameters>\n\t\t<RELEASE_VER_ID>".$RELEASE_VER_ID."</RELEASE_VER_ID>\n\t\t<CODE_NAME>".$CODE_NAME."</CODE_NAME>\n\t\t<TEXT_COMMENT>".$TEXT_COMMENT."</TEXT_COMMENT>\n\t\t<USER>".$ACTION_USER."</USER>\n\t\t<EVENT_NAME>".$EVENT_NAME."</EVENT_NAME>\n\t\t<DICT_VER_ID>".$DICT_VER_ID."</DICT_VER_ID>\n\t</parameters>\n</mpUpdate_Release_ver>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: ee37a8ca-ff48-c571-9df4-c247ee40e117",
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