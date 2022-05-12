<?php
	
// for($x=0;$x<10000;x++){};
for ($x = 0; $x <= 1000; $x++) {
	echo "The number is: $x <br>";
  }
$filter = "";
$limit = "";
$order = 0;
$no = 0;
$act="GetRiwayatNilaiMahasiswa";
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);

// $kosongkantabel = "TRUNCATE getnilaikuliahkelas;";
mysqli_query($db ,$kosongkantabel);

if ($ws_result[1]["error_code"] == 0) {

foreach ($ws_result as $key){
	if (is_array($key)){
	foreach ($key as $key2){
		if (is_array($key2)){
				foreach ($key2 as $key3){
$no++;
$id_registrasi_mahasiswa = $key3['id_registrasi_mahasiswa'];
$id_periode = $key3['id_periode'];
$id_matkul = $key3['id_matkul'];
$nama_mata_kuliah	= hapus_tanda($key3['nama_mata_kuliah']);
$id_kelas = $key3['id_kelas'];
$nama_kelas_kuliah = $key3['nama_kelas_kuliah'];
$sks_mata_kuliah = $key3['sks_mata_kuliah'];
$nilai_angka = $key3['nilai_angka'];
$nilai_huruf = $key3['nilai_huruf'];
$nilai_indeks = $key3['nilai_indeks'];
$nim = $key3['nim'];
$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
$angkatan = $key3['angkatan'];
// echo "\n$no - ".$nama_mahasiswa." MAKUL : ".$nama_mata_kuliah.", Nilai : ".$nilai_indeks;

$inserdb = "INSERT IGNORE INTO getnilaikuliahkelas 
(id_registrasi_mahasiswa, id_periode, id_matkul, nama_mata_kuliah, id_kelas, 
nama_kelas_kuliah, sks_mata_kuliah, nilai_angka, nilai_indeks, nilai_huruf, 
nim, nama_mahasiswa, angkatan) VALUES 
('$id_registrasi_mahasiswa', '$id_periode', '$id_matkul', '$nama_mata_kuliah', '$id_kelas', 
'$nama_kelas_kuliah', '$sks_mata_kuliah', '$nilai_angka', '$nilai_indeks', '$nilai_huruf', 
'$nim', '$nama_mahasiswa', '$angkatan');";
// echo $inserdb;
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
else {
	// clean_all_processes();
	// break;
}




$progress = "Get Data Selesai $no Record";
progress($progress,$act);

?>
