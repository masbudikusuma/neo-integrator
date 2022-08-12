<?php
$filter = "";
$limit = "";
$order = 0;
$act = 'GetAllProdi';
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getallprodi;";
mysqli_query($db ,$kosongkantabel);
$no = 0 ;
if ($ws_result[1]["error_code"] == 0) {
			foreach ($ws_result as $key){
				if (is_array($key)){
				foreach ($key as $key2){
					if (is_array($key2)){
							foreach ($key2 as $key3){
								$id_prodi = $key3['id_prodi'];
								$kode_program_studi = $key3['kode_program_studi'];
								$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
								$status = $key3['status'];
								$id_jenjang_pendidikan = $key3['id_jenjang_pendidikan'];
								$nama_jenjang_pendidikan = $key3['nama_jenjang_pendidikan'];
								$nama_perguruan_tinggi = hapus_tanda($key3['nama_perguruan_tinggi']);
								$id_perguruan_tinggi = $key3['id_perguruan_tinggi'];
								
								
$inserdb = "INSERT INTO getallprodi 
(id_prodi, kode_program_studi, nama_program_studi, status, id_jenjang_pendidikan, nama_jenjang_pendidikan,nama_perguruan_tinggi,id_perguruan_tinggi) VALUES 
('$id_prodi', '$kode_program_studi', '$nama_program_studi', '$status', '$id_jenjang_pendidikan', '$nama_jenjang_pendidikan','$nama_perguruan_tinggi','$id_perguruan_tinggi');
";								
echo ".";
$no++;
mysqli_query($db ,$inserdb) or die(mysqli_error($db));

							}
					} //IF Key2
				}
			} //IF Key1

}}

echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);
?>
