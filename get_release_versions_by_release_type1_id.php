<?php
$RELEASE_TYPE1_ID = $_POST['RELEASE_TYPE1_ID'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/get_release_versions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => "<get_release_versions>\r\n    <parameters>\r\n        <!--Optional:-->\r\n        <REQUEST_TYPE>BY_RELEASE_TYPE1</REQUEST_TYPE>\r\n        <!--Optional:-->\r\n        <RELEASE_VER_ID></RELEASE_VER_ID>\r\n        <!--Optional:-->\r\n        <RELEASE_TYPE1_ID>".$RELEASE_TYPE1_ID."</RELEASE_TYPE1_ID>\r\n    </parameters>\r\n</get_release_versions>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

$response = curl_exec($curl);

$err = curl_error($curl);
$xmlObject = simplexml_load_string($response);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
}else{
   $col = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0]->count();
		$rows = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT->count();
    echo "<option value='null_result'>Выберите из списка</option>";
		for($tr=0; $tr < $rows; $tr++) 
		{
			$array = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[$tr];
			$array1 = get_object_vars($array);
			$keys = array_keys($array1);
			$key_one = $keys[0];
			$key_two = $keys[2];
			$item_one = $array1[$key_one];
			$item_two = $array1[$key_two];
			echo "<option value='".$item_two."'>".$item_two."</option>";
			
		}
		
}
?>