<?php
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/SASBIWS/rest/storedProcesses/Projects/RTDMVersion/get_release_type1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<mpGet_Release_Type1>\n\t<parameters>\n\n\t</parameters>\n</mpGet_Release_Type1>",
  CURLOPT_HTTPHEADER => array(
    "accept: application/xml",
    "cache-control: no-cache",
    "content-type: application/xml",
    "postman-token: 8815138a-de80-4c72-9e8a-76d4b132ebbb",
    "user-agent: Jakarta Commons-HttpClient/3.1"
  ),
));

	$response = curl_exec($curl);
	$err1= curl_error($curl);
	$xmlObject = simplexml_load_string($response);
	curl_close($curl);

	if ($err1) 
	{
	  echo "cURL Error #:" . $err;
	}
	 else 
	{	
		$col = $xmlObject -> get_release_type1Result-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0]->count();
		$rows = $xmlObject -> get_release_type1Result-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT->count();

		echo "<option>Выберите из списка</option>";
		for($tr=0; $tr < $rows; $tr++) 
		{
			$array = $xmlObject -> get_release_type1Result-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[$tr];
			$array1 = get_object_vars($array);
			$keys = array_keys($array1);
			//for($td=0;$td<1;$td++)
			//{
				$key_one = $keys[0];
				$key_two = $keys[1];
				$item_one = $array1[$key_one];
				$item_two = $array1[$key_two];
				echo "<option value='".$item_one."'>".$item_two."</option>";

			//}
			
		}
	}	
?>