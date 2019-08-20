<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sasbap.demo.sas.com/RTDM/rest/decisionDefinitions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept-encoding: gzip, deflate",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {


  $json = json_decode($response);
  //print_r($json);
  //var_dump($json -> items -> count());
  $obj_cnt = count($json -> items);
  echo "<label for='copy_events_option'>Список ивентов</label>";
  echo "<select class='form-control' id='copy_events_option' name='copy_events_option'>";
  echo "<option>Выберите из списка</option";
  for($tr=0; $tr < $obj_cnt; $tr++)
  {
    $array = $json -> items[$tr] -> decisionId;
    echo "
    
    <option>".$array."</option>
   ";
  }
  echo " </select><br>";
}