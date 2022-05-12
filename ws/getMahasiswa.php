<?php

jmlmhs($jmlmhs);
$filter = "";
$limit = "";$order = 0;
$act = 'GetListMahasiswa';
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getmahasiswa;";
mysqli_query($db ,$kosongkantabel);
$no =0;

			if ($ws_result[1]["error_code"] == 0) {

						foreach ($ws_result as $key){
							if (is_array($key)){
							foreach ($key as $key2){
								if (is_array($key2)){
										foreach ($key2 as $key3){
								$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
								$jenis_kelamin	= $key3['jenis_kelamin'];
								$tanggal_lahir	= $key3['tanggal_lahir'];
								$tanggal_lahir = date("Y-m-d", strtotime($tanggal_lahir));  
								$id_perguruan_tinggi	= $key3['id_perguruan_tinggi'];
								$id_mahasiswa	= $key3['id_mahasiswa'];
								$id_agama	= $key3['id_agama'];
								$nama_agama	= $key3['nama_agama'];
								$id_prodi	= $key3['id_prodi'];
								$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
								// $id_status_mahasiswa	= $key3['id_status_mahasiswa'];
								$id_status_mahasiswa	= "";
								$nama_status_mahasiswa	= $key3['nama_status_mahasiswa'];
								$nim	= $key3['nipd'];
								$id_periode	= $key3['id_periode'];
								$nama_periode_masuk	= $key3['nama_periode_masuk'];
								$id_registrasi_mahasiswa	= $key3['id_registrasi_mahasiswa'];
								
								$no++;
							// echo $no.' '.$id_kelas_kuliah.'';

$inserdb = "INSERT INTO getmahasiswa 
(nama_mahasiswa, jenis_kelamin, tanggal_lahir, id_perguruan_tinggi, id_mahasiswa, 
id_agama, nama_agama, id_prodi, nama_program_studi, id_status_mahasiswa, 
nama_status_mahasiswa, nim, id_periode, nama_periode_masuk, id_registrasi_mahasiswa) VALUES 
('$nama_mahasiswa', '$jenis_kelamin', '$tanggal_lahir', '$id_perguruan_tinggi', '$id_mahasiswa', 
'$id_agama', '$nama_agama', '$id_prodi', '$nama_program_studi',	'$id_status_mahasiswa', 
'$nama_status_mahasiswa', '$nim', '$id_periode', '$nama_periode_masuk', '$id_registrasi_mahasiswa');";

							// echo $inserdb;
							mysqli_query($db ,$inserdb) or die(mysqli_error($db));

$statprogress = "data $no dari $jmlmhs";
// print_r($statprogress);
progress($statprogress,$act);
echo $buffer.".";
ob_flush();
flush();
										}
								} //IF Key2
							}
						} //IF Key1

}}
echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);

?>
