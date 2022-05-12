<?php
require_once "ws_pddikti.php";
require_once "config.php";
require_once "function.php";
ob_end_flush();
ob_implicit_flush();


if (isset($_GET['error'])){$error = $_GET['error'];$error="and err='$error'";} else {$error="and err is null";}
if (isset($_GET['awal'])){$awal  = $_GET['awal'];} else {$awal=0;}
if (isset($_GET['akhir'])){$akhir  = $_GET['akhir'];} else {$akhir=5;}
$query = "SELECT * from InsertPengajarKelas where  id BETWEEN $awal AND $akhir  order by id ASC";

$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			// $id_kelas_kuliah = $x['id_kelas_kuliah'];
			$data = array(
			 'id_registrasi_dosen' 	 => $x['id_registrasi_dosen'],
			 'id_kelas_kuliah' 	 => $x['id_kelas_kuliah'],
			 'id_substansi' 	 => $x['id_substansi'],
			 'sks_substansi_total' 	 => $x['sks_substansi_total'],
			 'rencana_minggu_pertemuan' 	 => $x['rencana_minggu_pertemuan'],
			 'realisasi_minggu_pertemuan' 	 => $x['realisasi_minggu_pertemuan'],
			 'id_jenis_evaluasi' 	 => $x['id_jenis_evaluasi'],
			);
			$request = $ws->prep_insert("InsertDosenPengajarKelasKuliah",$data);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_aktivitas_mengajar = $ws_result[1]["data"]["id_aktivitas_mengajar"];
	print_r("\n".$id." - ID Aktivitas Mengahar : ".$id_aktivitas_mengajar);
	$update = "UPDATE insertpengajarkelas 
		SET `err`='".$err_code."', `desc`='".$err_desc."', id_aktivitas_mengajar='".$id_aktivitas_mengajar."' WHERE  id=".$id.";";
		mysqli_query($db, $update);
}else {
	print_r("\n".$id." - : ".$err_code." - ".$err_desc);
	$update = "UPDATE insertpengajarkelas 
		SET `err`='".$err_code."', `desc`='".$err_desc."' WHERE  id=".$id.";";
		// echo $update;
		mysqli_query($db, $update);
}

}
}else {
	echo "data tidak ditemukan";
}





?>
