<?php
$DICT_VER_ID =$_POST['DICT_VER_ID'];

$input1 =$_POST['PARAMETER_NAME1'];
$input2 =$_POST['PARAMETER_NAME2'];
$input3 =$_POST['PARAMETER_NAME3'];

$input4 =$_POST['CHAR_VALUE1'];
$input5 =$_POST['CHAR_VALUE2'];
$input6 =$_POST['CHAR_VALUE3'];

$input7 =$_POST['NUM_VALUE1'];
$input8 =$_POST['NUM_VALUE2'];
$input9 =$_POST['NUM_VALUE3'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/create_new_dict_ver",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpCreate_New_DICT_Ver>\n\t<parameters>\n\t\t<REQUEST_TYPE>INSERT</REQUEST_TYPE>\n\t\t<DICT_VER_ID>".$DICT_VER_ID."</DICT_VER_ID>\n\t\t<PARAMETER_NAME1>".$input1."</PARAMETER_NAME1>\n\t\t<PARAMETER_NAME2>".$input2."</PARAMETER_NAME2>\n\t\t<PARAMETER_NAME3>".$input3."</PARAMETER_NAME3>\n\t\t<CHAR_VALUE1>".$input4."</CHAR_VALUE1>\n\t\t<CHAR_VALUE2>".$input5."</CHAR_VALUE2>\n\t\t<CHAR_VALUE3>".$input6."</CHAR_VALUE3>\n\t\t<NUM_VALUE1>".$input7."</NUM_VALUE1>\n\t\t<NUM_VALUE2>".$input8."</NUM_VALUE2>\n\t\t<NUM_VALUE3>".$input9."</NUM_VALUE3>\n\t</parameters>\n</mpCreate_New_DICT_Ver>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}