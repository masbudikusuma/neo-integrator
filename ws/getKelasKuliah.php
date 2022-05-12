<?php
echo "progress get data dari feeder .......";
// $filter = "id_semester='20211'";
if (isset($_GET['order'])){$order  = $_GET['order'];} else {$order=100;}
$filter = "";
$limit = "";
$order = "";
$act = "GetDetailKelasKuliah";

$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);
			
$kosongkantabel = "TRUNCATE getkelaskuliah;";
// mysqli_query($db ,$kosongkantabel);
$no = 0;
if ($ws_result[1]["error_code"] == 0) {
			foreach ($ws_result as $key){
				if (is_array($key)){
				foreach ($key as $key2){
					if (is_array($key2)){
							foreach ($key2 as $key3){
								$no++;
								$id_kelas_kuliah	= $key3['id_kelas_kuliah'];
								$id_prodi	= $key3['id_prodi'];
								$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
								$id_semester	= $key3['id_semester'];
								$nama_semester	= $key3['nama_semester'];
								$id_matkul	= $key3['id_matkul'];
								$kode_mata_kuliah	= $key3['kode_mata_kuliah'];
								$nama_mata_kuliah	= hapus_tanda($key3['nama_mata_kuliah']);
								$nama_kelas_kuliah	= hapus_tanda($key3['nama_kelas_kuliah']);
								$bahasan	= $key3['bahasan'];
								$tanggal_mulai_efektif	= $key3['tanggal_mulai_efektif'];
								$tanggal_akhir_efektif	= $key3['tanggal_akhir_efektif'];
								$kapasitas	= $key3['kapasitas'];
								$tanggal_tutup_daftar	= $key3['tanggal_tutup_daftar'];
								$prodi_penyelenggara	= $key3['prodi_penyelenggara'];
								$perguruan_tinggi_penyelenggara	= $key3['perguruan_tinggi_penyelenggara'];
								
								$id_key= $id_semester."_".$nama_kelas_kuliah."_".$kode_mata_kuliah."_".$id_prodi;

								$inserdb = "INSERT INTO getkelaskuliah 
(id_kelas_kuliah, id_prodi, nama_program_studi, id_semester, nama_semester, 
id_matkul, kode_mata_kuliah, nama_mata_kuliah, nama_kelas_kuliah, 
bahasan, tanggal_mulai_efektif, tanggal_akhir_efektif, kapasitas,id_key) VALUES 
('$id_kelas_kuliah', '$id_prodi', '$nama_program_studi', '$id_semester', '$nama_semester', 
'$id_matkul', '$kode_mata_kuliah', '$nama_mata_kuliah', '$nama_kelas_kuliah', 
'$bahasan', '$tanggal_mulai_efektif', '$tanggal_akhir_efektif', '$kapasitas','$id_key');";
							// echo $inserdb;
							mysqli_query($db ,$inserdb) or die(mysqli_error($db));

$progress = "\n".$no." - ID Kelas Kuliah : ".$id_kelas_kuliah;
progress($progress,$act);
// print_r($progress);

							}
					} //IF Key2
				}
			} //IF Key1

}}

$progress = "Get Data Selesai $no Record";
progress($progress,$act);






?>
