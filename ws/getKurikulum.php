<html>
	<title>JANGAN TUTUP BROWSER INI HINGGA PROSES SELESAI</title>
<!-- </html> -->
<?php
$filter = "";
$limit = "";
$order = 0;
$act = 'GetListKurikulum';
$no = 0;
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getkurikulum;";
mysqli_query($db ,$kosongkantabel);

if ($ws_result[1]["error_code"] == 0) {

			foreach ($ws_result as $key){
				if (is_array($key)){
				foreach ($key as $key2){
					if (is_array($key2)){
							foreach ($key2 as $key3){
$no++;
$id_jenj_didik = $key3['id_jenj_didik'];
$jml_sem_normal = $key3['jml_sem_normal'];
$id_kurikulum = $key3['id_kurikulum'];
$nama_kurikulum	= hapus_tanda($key3['nama_kurikulum']);
$id_prodi = $key3['id_prodi'];
$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
$id_semester = $key3['id_semester'];
$semester_mulai_berlaku = $key3['semester_mulai_berlaku'];
$jumlah_sks_lulus = $key3['jumlah_sks_lulus'];
$jumlah_sks_wajib = $key3['jumlah_sks_wajib'];
$jumlah_sks_pilihan = $key3['jumlah_sks_pilihan'];
$jumlah_sks_mata_kuliah_wajib = $key3['jumlah_sks_mata_kuliah_wajib'];
$jumlah_sks_mata_kuliah_pilihan = $key3['jumlah_sks_mata_kuliah_pilihan'];
								
$inserdb = "INSERT INTO getkurikulum 
(id_jenj_didik, jml_sem_normal, id_kurikulum, nama_kurikulum, id_prodi, 
nama_program_studi, id_semester, semester_mulai_berlaku, jumlah_sks_lulus, 
jumlah_sks_wajib, jumlah_sks_pilihan, jumlah_sks_mata_kuliah_wajib, jumlah_sks_mata_kuliah_pilihan) VALUES 
('$id_jenj_didik', '$jml_sem_normal', '$id_kurikulum', '$nama_kurikulum', '$id_prodi', 
'$nama_program_studi', '$id_semester', '$semester_mulai_berlaku', '$jumlah_sks_lulus', 
'$jumlah_sks_wajib', '$jumlah_sks_pilihan', '$jumlah_sks_mata_kuliah_wajib', '$jumlah_sks_mata_kuliah_pilihan');
";								

mysqli_query($db ,$inserdb) or die(mysqli_error($db));

$progress = " record ke-".$no;
progress($progress,$act);
// print_r($progress);
echo " .";

							}
					} //IF Key2
				}
			} //IF Key1

}}
echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);

?>
