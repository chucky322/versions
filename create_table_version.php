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
				"user-agent: Jakarta Commons-HttpClient/3.1"
			),
		)
	);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	//преобразовываю в string xml
	$xmlObject = simplexml_load_string($response);
	curl_close($curl);
	//вывожу ошибку, если не получилось получить данные
	if ($err) {
		echo "cURL Error #:" . $err;
	} 
	//в случае если все нормально
	else 
	{	
		//считаю количество колонок и записей
		$rows = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT->count();
		$col = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0]->count();
		$cols=$col;
		
		//создаю таблицу
		echo 
		"<div id class='table_with_content'>";
		echo "<table 
		class='table table-bordered table-hover'
		id='myTable'
		data-filter-control='true'
		data-toggle='table'
		data-sortable='true'
		data-single-select='true'
		data-click-to-select='true'
		data-filter-show-clear='true'
		data-show-columns='true'
		
		
		>";
		
		$arrayh = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[0];

			echo "<thead>";
				echo "<tr>";
					echo "<th data-field='state' data-checkbox='true'></th>";
					foreach($arrayh as $key => $item)
					{
							echo "
						<th data-field='".$key."'
						data-filter-control='input'
						data-sortable='true'
						";
						echo ">".$key."</th>";
					}
				echo "</tr>";
			echo "</thead>";
			
			echo "<tbody>";
			
				for($tr=0; $tr < $rows; $tr++) 
				{
					$array = $xmlObject -> get_release_versionsResult-> Streams-> _WEBOUT-> Value-> TABLE-> OUTPUT[$tr];
					$array1 = get_object_vars($array);
					$keys = array_keys($array1);
				
					echo "<tr><td>0</td>";
						for($td=0;$td<$cols;$td++)
						{
							$keyr = $keys[$td];
							$itemr = $array1[$keyr];
							//echo "";
							if($keyr=="NAME_STATUS" and "NAME_STATUS" == "In development") 
							{
								echo "<td>".$itemr."</td>";
							}
							else
							{
								echo "<td>".$itemr."</td>";
							}
						}
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";
	echo "</div>";
	}
?>			