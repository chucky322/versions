<?php
$SPEC_DICT =$_POST['SPEC_DICT'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/get_ver_num_dict",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpGet_V_Num_Dict>\n\t<parameters>\n\t\t<SPEC_DICT>".$SPEC_DICT."</SPEC_DICT>\n\t</parameters>\n</mpGet_V_Num_Dict>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: 00e703ac-6caa-8cd8-0b76-517705e50723",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

$response = curl_exec($curl);

$err = curl_error($curl);
$xmlObject = simplexml_load_string($response);

curl_close($curl);

if ($err) 
{
  echo "cURL Error #:" . $err;
}
else
{
 $col = $xmlObject -> get_ver_num_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0]->count();
  $rows = $xmlObject -> get_ver_num_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT->count();
  for($tr=0; $tr < $rows; $tr++) 
  {
    $array = $xmlObject -> get_ver_num_dictResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[$tr];
    $array1 = get_object_vars($array);
    $keys = array_keys($array1);
    $key_one = $keys[0];

    $item_one = $array1[$key_one];
    echo "<option value='".$item_one."'>".$item_one."</option>";
    
  }
}
?>