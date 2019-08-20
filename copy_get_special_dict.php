<?php
$SPEC_DICT =$_POST['COPY_SPEC_DICT'];
// 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/get_special_dict",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpGet_Special_Dict>\n\t<parameters>\n\t\t<TMP_OPTION>".$SPEC_DICT."</TMP_OPTION>\n\t</parameters>\n</mpGet_Special_Dict>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: f3a5e755-3425-0c92-299d-21ce675cca47",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$xmlObject = simplexml_load_string($response);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $doc = new DOMDocument;
  $doc->loadXML($response);

  $check_result_code=$doc->getElementsByTagName('RESULT_CODE')->item(0)->nodeValue;
  if( $check_result_code=="2")
  {
    echo "<ul class='list-group'>";
    echo " </ul><br>";
  }

  else
  {
    
     //echo $col = $xmlObject -> get_special_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0]->count();
  $rows = $xmlObject -> get_special_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT->count();

  echo "<ul class='list-group'>";
  for($tr=0; $tr < $rows; $tr++) 
  {
    $array = $xmlObject -> get_special_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[$tr];
    $array1 = get_object_vars($array);
    $keys = array_keys($array1);
    $key_one = $keys[0];
    $key_two = $keys[1];
    $key_three = $keys[2];
    $item_one = $array1[$key_one];
    $item_two = $array1[$key_two];
    $item_three = $array1[$key_three];
    echo "<li class='list-group-item test' value='".$item_one."'>".$item_two." версия ".$item_three."</option>";
  }
  echo " </ul><br>";
  }
  
}