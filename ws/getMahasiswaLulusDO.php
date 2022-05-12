<?php

$filter = "";
$limit = "";
$order = 0;
$act = 'GetDetailMahasiswaLulusDO';
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

			$kosongkantabel = "TRUNCATE getmahasiswalulusdo;";
			mysqli_query($db ,$kosongkantabel);
$no =0;

if ($ws_result[1]["error_code"] == 0) {

foreach ($ws_result as $key){
if (is_array($key)){
foreach ($key as $key2){
	if (is_array($key2)){
			foreach ($key2 as $key3){
	$id_registrasi_mahasiswa = $key3['id_registrasi_mahasiswa'];
	$id_prodi = $key3['id_prodi'];
	$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
	$id_mahasiswa = $key3['id_mahasiswa'];
	$nim = $key3['nim'];
	$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
	$angkatan = $key3['angkatan'];
	$id_jenis_keluar = $key3['id_jenis_keluar'];
	$nama_jenis_keluar = $key3['nama_jenis_keluar'];
	$tanggal_keluar = date("Y-m-d", strtotime('tanggal_keluar'));  
	$keterangan = $key3['keterangan'];
	$nomor_sk_yudisium = $key3['nomor_sk_yudisium'];
	$tanggal_sk_yudisium = date("Y-m-d", strtotime('tanggal_sk_yudisium'));  
	$ipk = $key3['ipk'];
	$nomor_ijazah = $key3['nomor_ijazah'];
	$jalur_skripsi = $key3['jalur_skripsi'];
	$judul_skripsi = $key3['judul_skripsi'];
	$bulan_awal_bimbingan = $key3['bulan_awal_bimbingan'];
	$bulan_akhir_bimbingan = $key3['bulan_akhir_bimbingan'];
	$id_dosen = $key3['id_dosen'];
	$nidn = $key3['nidn'];
	$nama_dosen	= hapus_tanda($key3['nama_dosen']);
	$pembimbing_ke = $key3['pembimbing_ke'];
	$asal_ijazah = $key3['asal_ijazah'];
	$id_periode_keluar = $key3['id_periode_keluar'];	
	
	$no++;
echo "\n".$no.'- NIM : '.$nim.' STATUS:'.$nama_jenis_keluar." Tanggal:".$tanggal_keluar;

$inserdb = "INSERT INTO getmahasiswalulusdo 
(id_reg_mahasiswa, id_mahasiswa, nim, nama_mahasiswa, id_jenis_keluar, 
nama_jenis_keluar, tanggal_keluar, keterangan, nomor_sk_yudisium, tanggal_sk_yudisium, 
nomor_ijazah, ipk, jalur_skripsi, judul_skripsi, bulan_awal_bimbingan, 
bulan_akhir_bimbingan, id_dosen, nidn, nama_dosen, pembimbing_ke, 
id_periode_keluar, id_prodi, nama_program_studi, angkatan) VALUES 
('$id_registrasi_mahasiswa', '$id_mahasiswa', '$nim', '$nama_mahasiswa', '$id_jenis_keluar', 
'$nama_jenis_keluar', '$tanggal_keluar', '$keterangan', '$nomor_sk_yudisium', '$tanggal_sk_yudisium', 
'$nomor_ijazah', '$ipk', '$jalur_skripsi', '$judul_skripsi', '$bulan_awal_bimbingan', 
'$bulan_akhir_bimbingan', '$id_dosen', '$nidn', '$nama_dosen', '$pembimbing_ke', 
'$id_periode_keluar', '$id_prodi', '$nama_program_studi', '$angkatan')
";

							// echo $inserdb;
							mysqli_query($db ,$inserdb) or die(mysqli_error($db));

										}
								} //IF Key2
							}
						} //IF Key1

}}






?>
