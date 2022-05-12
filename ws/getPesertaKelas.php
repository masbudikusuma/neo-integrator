<?php
$filter = "";
$limit = "10000";
$order = 0;
$act = 'GetPesertaKelasKuliah';
$request = $ws->prep_get($act,$filter,$limit,$order);
$ws_result = $ws->run($request);
// $ws->view($ws_result);
// 
$kosongkantabel = "TRUNCATE getpesertaKelas;";
mysqli_query($db ,$kosongkantabel);

if ($ws_result[1]["error_code"] == 0) {
$no = 0;
foreach ($ws_result as $key){
if (is_array($key)){
foreach ($key as $key2){
if (is_array($key2)){
		foreach ($key2 as $key3){
			$id_kelas_kuliah = $key3['id_kelas_kuliah'];
			$nama_kelas_kuliah = $key3['nama_kelas_kuliah'];
			$id_registrasi_mahasiswa = $key3['id_registrasi_mahasiswa'];
			$id_mahasiswa = $key3['id_mahasiswa'];
			$nim = $key3['nim'];
			$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
			$id_matkul = $key3['id_matkul'];
			$kode_mata_kuliah = $key3['kode_mata_kuliah'];
			$nama_mata_kuliah	= hapus_tanda($key3['nama_mata_kuliah']);
			$id_prodi = $key3['id_prodi'];
			$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
			$angkatan = $key3['angkatan'];										

			$no++;
		// echo $no." - MATAKULIAH : ".$nama_mata_kuliah.", Nama Siswa : ".$nama_mahasiswa."\n";

$inserdb = "INSERT INTO getpesertakelas 
(id_kelas_kuliah, nama_kelas_kuliah, id_registrasi_mahasiswa, id_mahasiswa, nim, 
nama_mahasiswa, id_matkul, kode_mata_kuliah, nama_mata_kuliah, id_prodi, 
nama_program_studi, angkatan) VALUES 
('$id_kelas_kuliah', '$nama_kelas_kuliah', '$id_registrasi_mahasiswa', '$id_mahasiswa', '$nim', 
'$nama_mahasiswa', '$id_matkul', '$kode_mata_kuliah', '$nama_mata_kuliah', '$id_prodi', 
'$nama_program_studi', '$angkatan');";
// echo $inserdb;
mysqli_query($db ,$inserdb) or die(mysqli_error($db));
$progress = " record ke-".$no;
progress($progress,$act);
echo $buffer.".";
ob_flush();
flush();
				}
		} //IF Key2
	}
} //IF Key1

}}

echo $no." record";
$status =  "Get Data Terakhir Selesai ".$no." record";
progress($status,$act);
?>
