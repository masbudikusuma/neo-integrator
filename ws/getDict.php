<?php
$curlfeeder = curl_init();
  curl_setopt_array($curlfeeder, array(
  CURLOPT_URL => $urlfeeder."/ws/live2.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  // CURLOPT_POSTFIELDS => "idpel=$key3&nopel=$sender&amount=&code=PLNPASC",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
      ),
  ));

  $response = curl_exec($curlfeeder);
  echo "\n================================================================================\n";
  print_r($response);
  echo "\n================================================================================\n";

if (isset($_GET['mod'])){
  echo "MENAMPILKAN DICTIONARY UNTUK MELIHAT TIPE DATA ".$_GET['mod'];
	$fungsi  = $_GET['mod'];
	} else {
    $fungsi = "";
    echo "gunakan &mod= untuk melihat tipedata CONTOH: /exec.php?act=dict&mod=GetProdi ";}

// $fungsi = "GetDetailKelasKuliah";
$request = $ws->prep_dict('GetDictionary',$fungsi);
$ws_result = $ws->run($request);
// print_r($ws_result);
$ws->view($ws_result);

?>
