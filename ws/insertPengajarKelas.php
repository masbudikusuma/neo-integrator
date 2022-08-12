<?php

// GET ID REGISTRASI DOSEN
// UPDATE insertpengajarkelas as t1
// LEFT JOIN getpenugasandosen AS t2 ON t2.nidn = t1.nidn
// SET  t1.id_registrasi_dosen = t2.id_registrasi_dosen 
// WHERE t2.id_registrasi_dosen IS NOT null;

// Membuat ID_Key pencarian KelasKuliah
// UPDATE insertpengajarkelas as t1
// SET  t1.id_key = concat(t1.id_semester,"_",t1.kode_kelas,"_",t1.kode_mk,"_",t1.id_prodi);

// Mencari ID KELAS KULIAH setelah mencari idKEY
#SELECT * FROM insertpengajarkelas AS dosen
#LEFT JOIN getkelaskuliah AS kelas ON dosen.id_key	= kelas.id_key
#WHERE kelas.id_key IS NOT null

// UPDATE insertpengajarkelas AS dosen
// LEFT JOIN getkelaskuliah AS kelas ON dosen.id_key = kelas.id_key
// SET dosen.id_kelas_kuliah = kelas.id_kelas_kuliah
// WHERE kelas.id_key IS NOT NULL;
$query = "SELECT * from insertpengajarkelas where  err_no is null or err_no != '0' order by id ASC";
echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			// $id_kelas_kuliah = $x['id_kelas_kuliah'];
			$data = array(
			 'id_registrasi_dosen' 	 => $x['id_registrasi_dosen'],
			 'id_kelas_kuliah' 	 => $x['id_kelas_kuliah'],
			//  'id_substansi' 	 => $x['id_substansi'],
			 'sks_substansi_total' 	 => $x['sks_substansi_total'],
			 'rencana_minggu_pertemuan' 	 => $x['rencana_minggu_pertemuan'],
			 'realisasi_minggu_pertemuan' 	 => $x['realisasi_minggu_pertemuan'],
			 'id_jenis_evaluasi' 	 => $x['id_jenis_evaluasi'],
			);
			$act = "InsertDosenPengajarKelasKuliah";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);
			print_r($data);
			error_log($data);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_aktivitas_mengajar = $ws_result[1]["data"]["id_aktivitas_mengajar"];
	$update = "UPDATE insertpengajarkelas 
		SET `err_no`='".$err_code."', `err_desc`='".$err_desc."', id_aktivitas_mengajar='".$id_aktivitas_mengajar."' WHERE  id=".$id.";";
		mysqli_query($db, $update);

	// $progress = "\n".$id." - ID Aktivitas Mengajar : ".$id_aktivitas_mengajar;
	progress($progress,$act);
	print_r($progress);
}else {
	// print_r("\n".$id." - : ".$err_code." - ".$err_desc);
	$update = "UPDATE insertpengajarkelas 
		SET `err_no`='".$err_code."', `err_desc`='".$err_desc."' WHERE  id=".$id.";";
		mysqli_query($db, $update);

	// $progress = "\n".$id." - : ".$err_code." - ".$err_desc;
	progress($progress,$act);
	print_r($progress);
}

}
}else {
	echo "data Pengajar Kelas tidak ditemukan";
}


$status =  "Inject Terakhir Selesai";
progress($status,$act);




?>
