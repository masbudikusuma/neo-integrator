<?php
$filter = "";
$limit = ""; //unlimited
$order = 0;
$act = "GetDetailMataKuliah";
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getmatakuliah;";
mysqli_query($db ,$kosongkantabel);
$no = 0;
if ($ws_result[1]["error_code"] == 0) {

			foreach ($ws_result as $key){
				if (is_array($key)){
				foreach ($key as $key2){
					if (is_array($key2)){
							foreach ($key2 as $key3){
								$id_matkul = $key3['id_matkul'];
								$kode_mata_kuliah = $key3['kode_mata_kuliah'];
								$nama_mata_kuliah	= hapus_tanda($key3['nama_mata_kuliah']);
								$id_prodi = $key3['id_prodi'];
								$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
								$id_jenis_mata_kuliah = $key3['id_jenis_mata_kuliah'];
								$id_kelompok_mata_kuliah = $key3['id_kelompok_mata_kuliah'];
								$sks_mata_kuliah = $key3['sks_mata_kuliah'];
								$sks_tatap_muka = $key3['sks_tatap_muka'];
								$sks_praktek = $key3['sks_praktek'];
								$sks_praktek_lapangan = $key3['sks_praktek_lapangan'];
								$sks_simulasi = $key3['sks_simulasi'];
								$metode_kuliah = $key3['metode_kuliah'];
								$ada_sap = $key3['ada_sap'];
								$ada_silabus = $key3['ada_silabus'];
								$ada_bahan_ajar = $key3['ada_bahan_ajar'];
								$ada_acara_praktek = $key3['ada_acara_praktek'];
								$ada_diktat = $key3['ada_diktat'];
								$tanggal_mulai_efektif = $key3['tanggal_mulai_efektif'];
								$tanggal_selesai_efektif = $key3['tanggal_selesai_efektif'];
								$no++;
								
$inserdb = "INSERT INTO getmatakuliah 
(id_matkul, kode_mata_kuliah, nama_mata_kuliah, id_prodi, nama_program_studi, 
id_jenis_mata_kuliah, id_kelompok_mata_kuliah, sks_mata_kuliah, sks_tatap_muka, sks_praktek, 
sks_praktek_lapangan, sks_simulasi, metode_kuliah, ada_sap, ada_silabus, 
ada_bahan_ajar, ada_acara_praktek, ada_diktat, tanggal_mulai_efektif, tanggal_selesai_efektif) VALUES 
('$id_matkul', '$kode_mata_kuliah', '$nama_mata_kuliah', '$id_prodi', '$nama_program_studi', 
'$id_jenis_mata_kuliah', '$id_kelompok_mata_kuliah', '$sks_mata_kuliah', '$sks_tatap_muka', '$sks_praktek', 
'$sks_praktek_lapangan', '$sks_simulasi', '$metode_kuliah', '$ada_sap', '$ada_silabus', 
'$ada_bahan_ajar', '$ada_acara_praktek', '$ada_diktat', '$tanggal_mulai_efektif', '$tanggal_selesai_efektif')
";
							mysqli_query($db ,$inserdb) or die(mysqli_error($db));

$progress = "record ke-".$no;
progress($progress,$act);
// echo ".";
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
// echo "<script>window.close();</script>";
?>