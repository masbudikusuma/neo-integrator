<?php
  $filter = "";
  $limit = "";
  $order = 0;
  $act = 'GetDosenPengajarKelasKuliah';
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

			$kosongkantabel = "TRUNCATE getpengajarkelas;";
			mysqli_query($db ,$kosongkantabel);
$no = 0;
			if ($ws_result[1]["error_code"] == 0) {

				foreach ($ws_result as $key){
					if (is_array($key)){
					foreach ($key as $key2){
						if (is_array($key2)){
								foreach ($key2 as $key3){
									$id_aktivitas_mengajar = $key3['id_aktivitas_mengajar'];
									$id_registrasi_dosen = $key3['id_registrasi_dosen'];
									$id_dosen = $key3['id_dosen'];
									$nidn = $key3['nidn'];
									$nama_dosen	= hapus_tanda($key3['nama_dosen']);
									$id_kelas_kuliah = $key3['id_kelas_kuliah'];
									$nama_kelas_kuliah = $key3['nama_kelas_kuliah'];
									$id_substansi = $key3['id_substansi'];
									$sks_substansi_total = $key3['sks_substansi_total'];
									$rencana_minggu_pertemuan = $key3['rencana_minggu_pertemuan'];
									$realisasi_minggu_pertemuan = $key3['realisasi_minggu_pertemuan'];
									$id_jenis_evaluasi = $key3['id_jenis_evaluasi'];
									$nama_jenis_evaluasi = $key3['nama_jenis_evaluasi'];

									$no++;
								// echo $no.' '.$id_aktivitas_mengajar.' '.$nama_dosen."\n";

$inserdb = "INSERT INTO getpengajarkelas 
(id_aktivitas_mengajar, id_registrasi_dosen, id_dosen, nidn, nama_dosen, 
id_kelas_kuliah, nama_kelas_kuliah, id_substansi, sks_substansi_total, 
rencana_minggu_pertemuan, realisasi_minggu_pertemuan, id_jenis_evaluasi, nama_jenis_evaluasi) VALUES 
('$id_aktivitas_mengajar','$id_registrasi_dosen','$id_dosen','$nidn','$nama_dosen',
'$id_kelas_kuliah','$nama_kelas_kuliah','$id_substansi','$sks_substansi_total',
'$rencana_minggu_pertemuan','$realisasi_minggu_pertemuan','$id_jenis_evaluasi','$nama_jenis_evaluasi');";
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
echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);
?>
