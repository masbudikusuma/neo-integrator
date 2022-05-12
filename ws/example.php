<?php
	require_once "ws_pddikti.php";
	require_once "config.php";


	$urlfeeder = "";
	$userfeeder = "";
  	$passfeeder = "";
	$ws = new Ws_pddikti($urlfeeder,$userfeeder,$passfeeder);
	// $request = $ws->prep_get("GetProfilPT");
	// $result = $ws->run($request);
	// $ws->view($result);



	require_once "function.php";

ob_end_flush();
ob_implicit_flush();

if (isset($_GET['awal']))	{$awal = $_GET['awal'];} 	else {$awal="1";}
if (isset($_GET['akhir']))	{$akhir = $_GET['akhir'];} 	else {$akhir="2";}



// DELETE PESERTA KELAS KULIAH
$query = "SELECT * from Feeder_getPengajar where error is null and id BETWEEN $awal AND $akhir order by id ASC";
// SELECT * from Feeder_Peserta_Kelas_Kuliah where error is null and id BETWEEN $awal AND $akhir order by id ASC ";
$hasil = mysqli_query($db, $query);
if( mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$id_aktivitas_mengajar = $x['id_aktivitas_mengajar'];
			// $id_reg_mahasiswa = $x['id_reg'];

			$data = array(
			 'id_aktivitas_mengajar' 	=> $id_aktivitas_mengajar
			);
			$request = $ws->prep_delete("DeleteDosenPengajarKelasKuliah",$data);
			$ws_result = $ws->run($request);
			// $ws_result = $ws->view($result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

$update = "UPDATE Feeder_getPengajar SET error='$err_code',
descr='$err_desc' WHERE  id=$id";
mysqli_query($db, $update);
print_r($id." - ". $err_code." - ".$err_desc);


}
}else {
	echo "data tidak ditemukan";
}



?>
