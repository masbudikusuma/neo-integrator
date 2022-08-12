<?php
// require_once "ws_pddikti.php";
// require_once "config.php";
// require_once "function.php";
// ob_end_flush();
// ob_implicit_flush();

$filter = "";
$limit = "";
$order = 0;$no = 0;
$act = "GetListPerkuliahanMahasiswa";
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getakm;";
mysqli_query($db ,$kosongkantabel);

if ($ws_result[1]["error_code"] == 0) {

foreach ($ws_result as $key){
	if (is_array($key)){
	foreach ($key as $key2){
		if (is_array($key2)){
				foreach ($key2 as $key3){
$no++;
$id_registrasi_mahasiswa = $key3['id_registrasi_mahasiswa'];
$nim = $key3['nim'];
$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
$id_prodi = $key3['id_prodi'];
$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
$angkatan = $key3['angkatan'];
$id_periode_masuk = $key3['id_periode_masuk'];
$id_semester = $key3['id_semester'];
$nama_semester = $key3['nama_semester'];
$id_status_mahasiswa = $key3['id_status_mahasiswa'];
$nama_status_mahasiswa = $key3['nama_status_mahasiswa'];
$ips = $key3['ips'];
$ipk = $key3['ipk'];
$sks_semester = $key3['sks_semester'];
$sks_total = $key3['sks_total'];
$biaya_kuliah_smt = $key3['biaya_kuliah_smt'];

echo "\n$no - ".$nim." Semester : ".$nama_semester;

$inserdb = "INSERT INTO getakm 
(id_registrasi_mahasiswa, nama_mahasiswa, nim, id_prodi, 
nama_program_studi, angkatan, id_semester, nama_semester, 
id_status_mahasiswa, nama_status_mahasiswa, ips, ipk, 
sks_semester, sks_total, biaya_kuliah_smt) VALUES 
('$id_registrasi_mahasiswa', '$nama_mahasiswa', '$nim', '$id_prodi', 
'$nama_program_studi', '$angkatan', '$id_semester', '$nama_semester', 
'$id_status_mahasiswa', '$nama_status_mahasiswa', '$ips', '$ipk', 
'$sks_semester', '$sks_total', '$biaya_kuliah_smt');
";
// echo $inserdb;
mysqli_query($db ,$inserdb) or die(mysqli_error($db));
$progress = "\n".$no." - ID Reg MHS : ".$id_registrasi_mahasiswa."Semester : ".$nama_semester;
// progress($progress,$act);
// print_r($progress);
							}
					} //IF Key2
				}
			} //IF Key1

}}


echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);

?>
