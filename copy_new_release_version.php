<?php
session_start();

$RELEASE_VERSION=$_POST['COPY_RELEASE_VERSION'];
$RELEASE_TYPE1_ID=$_POST['COPY_RELEASE_TYPE1_ID'];

$TEXT_COMMENT=$_POST['COPY_TEXT_COMMENT'];
$USER=$_SESSION['username'];
$EVENT_NAME=$_POST['COPY_EVENT_NAME'];
$DICT_VER_ID=$_POST['COPY_DICT_VER_ID'];

$RELEASE_TYPE_ID="";
switch ($RELEASE_TYPE1_ID) {
case "A":
      $RELEASE_TYPE_ID=1;
    break;
case "A":
      $RELEASE_TYPE_ID=2;
    break;
case "A":
      $RELEASE_TYPE_ID=3;
    break;
}
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/create_release_versions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpCreate_Release_Versions>\n\t<parameters>\n\t\t<REQUEST_TYPE>ADD_RELEASE_VERSION</REQUEST_TYPE>\n\t\t<RELEASE_VERSION>".$RELEASE_VERSION."</RELEASE_VERSION>\n\t\t<RELEASE_TYPE1_ID>".$RELEASE_TYPE_ID."</RELEASE_TYPE1_ID>\n\t\t<TEXT_COMMENT>".$TEXT_COMMENT."</TEXT_COMMENT>\n\t\t<USER>".$USER."</USER>\n\t\t<EVENT_NAME>".$EVENT_NAME."</EVENT_NAME>\n\t\t<DICT_VER_ID>".$DICT_VER_ID."</DICT_VER_ID>\n\t</parameters>\n</mpCreate_Release_Versions>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: 68b7b49b-58e9-e447-4d9b-761c2ee830b1",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $doc = new DOMDocument;
  $doc->loadXML($response);

  $check_result_code=$doc->getElementsByTagName('RESULT_CODE')->item(0)->nodeValue;
  echo json_encode($check_result_code);
}