<?php
// GetProdi
// set url
$url = "http://feeder:8082/ws/live2.php";
$username = "";
$password = "";

// echo "makan";
pddikti_gettoken($username,$password,$url,$respon);
// echo $respon;
 $obj = json_decode($respon,true);
 var_dump($obj);
 echo "<br>";
 print $obj->{'data'};
echo $hasil;
echo $obj['data']['token'];
foreach($obj['data'] as $data) {
    echo $obj['data'];
}


function pddikti_get($url)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
echo $output;
}


function pddikti_post($url,$data,&$respon){
  // $postdata = json_encode($data);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $respon = curl_exec($ch);
  curl_close($ch);
  // $respon = json_decode($result);
  // print $res;
  return $respon;
  // print_r ($result);
}


function pddikti_gettoken($username,$password,$url,&$respon)
{
  $data = array(
    'act' => 'GetToken',
    'username' => $username,
    'password' => $password,
  );
  $data = json_encode($data);
   pddikti_post($url,$data,$respon);
   $respon = $respon;
   return $respon;
  // return $respon;
}
 ?>
