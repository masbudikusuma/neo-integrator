<?php
$filter = "";
$limit = "";
$order = 0;
$act = "GetMatkulKurikulum";
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);
			// echo "progress save to database";

$kosongkantabel = "TRUNCATE getmatkulkurikulum;";
mysqli_query($db ,$kosongkantabel);
$id = 0;
if ($ws_result[1]["error_code"] == 0) {
	foreach ($ws_result as $key){
		if (is_array($key)){
		foreach ($key as $key2){
			if (is_array($key2)){
					foreach ($key2 as $key3){
						$id++;
						$tgl_create = $key3['tgl_create'];
						$tgl_create = date("Y-m-d", strtotime($tgl_create));  
						$id_kurikulum = $key3['id_kurikulum'];
						$nama_kurikulum = hapus_tanda($key3['nama_kurikulum']);
						$id_matkul = $key3['id_matkul'];
						$kode_mata_kuliah = $key3['kode_mata_kuliah'];
						$nama_mata_kuliah = hapus_tanda($key3['nama_mata_kuliah']);
						$id_prodi = $key3['id_prodi'];
						$nama_program_studi = hapus_tanda($key3['nama_program_studi']);
						$semester = $key3['semester'];
						$id_semester = $key3['id_semester'];
						$semester_mulai_berlaku = $key3['semester_mulai_berlaku'];
						$sks_mata_kuliah = $key3['sks_mata_kuliah'];
						$sks_tatap_muka = $key3['sks_tatap_muka'];
						$sks_praktek = $key3['sks_praktek'];
						$sks_praktek_lapangan = $key3['sks_praktek_lapangan'];
						$sks_simulasi = $key3['sks_simulasi'];
						$apakah_wajib = $key3['apakah_wajib'];
			// print_r("\n".$id." - : ".$id_kurikulum." - ".$nama_kurikulum);								
					
						$inserdb = "INSERT INTO getmatkulkurikulum 
						(tgl_create, id_kurikulum, nama_kurikulum, id_matkul, kode_mata_kuliah, 
						nama_mata_kuliah, id_prodi, nama_program_studi, semester, id_semester, 
						semester_mulai_berlaku, sks_mata_kuliah, sks_tatap_muka, sks_praktek, 
						sks_praktek_lapangan, sks_simulasi, apakah_wajib) VALUES 
						('$tgl_create', '$id_kurikulum', '$nama_kurikulum', '$id_matkul', '$kode_mata_kuliah', 
						'$nama_mata_kuliah', '$id_prodi', '$nama_program_studi', '$semester', '$id_semester', 
						'$semester_mulai_berlaku', '$sks_mata_kuliah', '$sks_tatap_muka', '$sks_praktek', 
						'$sks_praktek_lapangan', '$sks_simulasi', '$apakah_wajib');
						";
						mysqli_query($db ,$inserdb) or die(mysqli_error($db));

$progress = " record ke-".$id;
progress($progress,$act);
echo $buffer.".";
ob_flush();
flush();
					}
			} //IF Key2
		}
	} //IF Key1
}}

echo $id." record";
$status =  "Get Data Terakhir Selesai ".$id." record";
progress($status,$act);
?>
