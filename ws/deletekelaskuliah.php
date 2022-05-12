<?php
	require_once "ws_pddikti.php";
	require_once "config.php";
	require_once "function.php";
	ob_end_flush();
  ob_implicit_flush();

	if (isset($_GET['error'])){
$error = $_GET['error'];
$error="and error='$error'";
} else {$error="and error is null";}

// $error = $_GET['error'];

$awal  = $_GET['awal'];
$akhir = $_GET['akhir'];
// DELETE PESERTA KELAS KULIAH
$query = "SELECT * from getKelasKuliah where  id BETWEEN $awal AND $akhir $error GROUP BY id_kelas_kuliah  order by id ASC";
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$id_kelas_kuliah = $x['id_kelas_kuliah'];
			$data = array(
			 'id_kelas_kuliah' 	=> $id_kelas_kuliah
			);
			$request = $ws->prep_delete("DeleteKelasKuliah",$data);
			$ws_result = $ws->run($request);
			// $ws_result = $ws->view($result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

$update = "UPDATE getKelasKuliah SET error='$err_code',
descr='$err_desc' WHERE  id=$id";
mysqli_query($db, $update);
print_r($id." - ". $err_code." - ".$err_desc);


}
}else {
	echo "data tidak ditemukan";
}





?>
