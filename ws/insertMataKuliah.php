<?php
echo "Jangan Tutup Browser Ini Hingga Proses Selesai";

$query = "SELECT * from insertmatakuliah where err_no is null or err_no != '0' order by id ASC";
$no = 0;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			
			if (isset($_GET['tipe'])){$tipe = $_GET['tipe'];} else {$tipe="lengkap";}
			switch ($tipe) {
				case "minim":
					$data = array(
						'kode_mata_kuliah' => $x['kode_mata_kuliah'],
						'nama_mata_kuliah' => $x['nama_mata_kuliah'],
						'id_prodi' =>  $x['id_prodi'],
						'id_jenis_mata_kuliah' => $x['id_jenis_mata_kuliah'],
						'sks_mata_kuliah' => $x['sks_mata_kuliah'],
						'sks_tatap_muka' => $x['sks_mata_kuliah'],
						'sks_praktek' => 0,
						'sks_praktek_lapangan' => 0,
						'sks_simulasi' => 0,
					);
				  break;
print_r($data);
				default:
				$data = array(
					'kode_mata_kuliah' => $x['kode_mata_kuliah'],
					'nama_mata_kuliah' => $x['nama_mata_kuliah'],
					'id_prodi' => $x['id_prodi'],
					'nama_program_studi' => $x['nama_program_studi'],
					'id_jenis_mata_kuliah' => $x['id_jenis_mata_kuliah'],
					'id_kelompok_mata_kuliah' => $x['id_kelompok_mata_kuliah'],
					'sks_mata_kuliah' => $x['sks_mata_kuliah'],
					'sks_tatap_muka' => $x['sks_tatap_muka'],
					'sks_praktek' => $x['sks_praktek'],
					'sks_praktek_lapangan' => $x['sks_praktek_lapangan'],
					'sks_simulasi' => $x['sks_simulasi'],
					'metode_kuliah' => $x['metode_kuliah'],
					'ada_sap' => $x['ada_sap'],
					'ada_silabus' => $x['ada_silabus'],
					'ada_bahan_ajar' => $x['ada_bahan_ajar'],
					'ada_acara_praktek' => $x['ada_acara_praktek'],
					'ada_diktat' => $x['ada_diktat'],
					'tanggal_mulai_efektif' => $x['tanggal_mulai_efektif'],
					'tanggal_selesai_efektif' => $x['tanggal_selesai_efektif'],
				);
			}
			$kode_mata_kuliah = $x['kode_mata_kuliah'];
			$nama_mata_kuliah = $x['nama_mata_kuliah'];
			$id_prodi =  $x['id_prodi'];
			$id_jenis_mata_kuliah = $x['id_jenis_mata_kuliah'];
			$sks_mata_kuliah = $x['sks_mata_kuliah'];
			
			$act = 'InsertMataKuliah';
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);
$no++;
$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_mk = $ws_result[1]['data']["id_mk"];
	$update = "UPDATE insertmatakuliah SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	$progress = "\n".$id." ".$x['nama_mata_kuliah']." - ID MK : ". $id_mk;
	progress($progress,$act);
	// insert to GetMK
$inserdb = "INSERT IGNORE  INTO getmatakuliah 
(id_matkul, kode_mata_kuliah, nama_mata_kuliah, id_prodi, id_jenis_mata_kuliah, sks_mata_kuliah) VALUES 
('$id_mk', '$kode_mata_kuliah', '$nama_mata_kuliah', '$id_prodi','$id_jenis_mata_kuliah','$sks_mata_kuliah' )
";
mysqli_query($db ,$inserdb) or die(mysqli_error($db));
	// print_r($progress);
}else {
	// print_r();
	$update = "UPDATE insertmatakuliah SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	$progress = "\n".$id." - ". $x['nama_mata_kuliah']." : ".$err_code." - ".$err_desc;
	progress($progress,$act);
	// print_r($progress);
}

$update = "UPDATE insertmatakuliah SET err='$err_code', descr='$err_desc' WHERE  id=$id";
mysqli_query($db, $update);

}
}else {
	echo "data tidak ditemukan";
}
echo "<br><b>Jumlah Data :</b> ".$no." record";
$status =  "Inject Terakhir Selesai";
progress($status,$act);


// echo "<script>window.close();</script>";
?>
