<?php

include_once 'component/version.php';

// Diisi alamat Servernya, Semisal menggunakan IP berarti diisi http://192.168.1.1/
$weburl = "";
  
// Konfigurasi Database Neo Integrator 
$db_server   = "";
$db_username = "";
$db_password = "";
$db_database = "";
$db = mysqli_connect($db_server,$db_username,$db_password,$db_database);

include_once 'component/ws_pddikti.php';

// AKUN PDDIKTI / NEO-FEEDER
$urlfeeder  = "";   // contoh http://192.168.1.1:8100
$userfeeder = "";   // User PDDIKTI
$passfeeder = "";   // Pass PDDIKTI
$ws = new Ws_pddikti($urlfeeder."/ws/live2.php",$userfeeder,$passfeeder);

date_default_timezone_set("Asia/Bangkok");
$date = date('Y-m-d h:i:s', time());
$id_insert = time();

include_once 'component/ws_pddikti.php';
include_once 'component/function.php';
ini_set('max_execution_time', '100000');

?>
