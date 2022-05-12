<?php
$filter = "";
$limit = "";
$order = 0;
$act = 'DetailBiodataDosen';
$request = $ws->prep_get($act,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$kosongkantabel = "TRUNCATE getDosen;";
mysqli_query($db ,$kosongkantabel);

if ($ws_result[1]["error_code"] == 0) {

			foreach ($ws_result as $key){
				if (is_array($key)){
				foreach ($key as $key2){
					if (is_array($key2)){
							foreach ($key2 as $key3){
								$cari_huruf = array("'",'&amp;','&copy;','&crarr;','&dArr;','&deg;','&divide;','&eacute;','&fnof;','&frasl;','&ge;','&harr;','&hArr;','&hellip;','&larr;','&lArr;','&ldquo;','&le;','&lowast;','&lsquo;','&mdash;','&nbsp;','&ndash;','&ne;','&plusmn;','&prime;','&Prime;','&quot;','&rarr;','&rArr;','&rdquo;','&reg;','&rsquo;','&sect;','&sum;','&times;','&uarr;','&uArr;','&lt;br /&gt;','&lt;','&gt;','%','&check;','&raquo;','&laquo;');
								$huruf_baru = array("",'&','©','?','?','°','÷','é','ƒ','?','?','?','?','…','?','?','“','?','?','','','','-','?','±','?','?','"','?','?','','®','','§','?','×','?','?','','<','>',"","✓",">>","<<");

								$id_dosen = $key3['id_dosen'];
								$nama_dosen	= hapus_tanda($key3['nama_dosen']);
								$tempat_lahir = $key3['tempat_lahir'];
								$tanggal_lahir = $key3['tanggal_lahir'];
								$tanggal_lahir = date("Y-m-d", strtotime($tanggal_lahir));  
								$jenis_kelamin = $key3['jenis_kelamin'];
								$id_agama = $key3['id_agama'];
								$nama_agama = $key3['nama_agama'];
								$id_status_aktif = $key3['id_status_aktif'];
								$nama_status_aktif = $key3['nama_status_aktif'];
								$nidn = $key3['nidn'];
								$nama_ibu_kandung	= hapus_tanda($key3['nama_ibu_kandung']);
								$nik = $key3['nik'];
								$nip	= hapus_tanda($key3['nip']);
								// $nip = $key3['nip'];
								$npwp = $key3['npwp'];
								$id_jenis_sdm = $key3['id_jenis_sdm'];
								$nama_jenis_sdm = $key3['nama_jenis_sdm'];
								$no_sk_cpns = $key3['no_sk_cpns'];
								$tanggal_sk_cpns = $key3['tanggal_sk_cpns'];
								$no_sk_pengangkatan = $key3['no_sk_pengangkatan'];
								$mulai_sk_pengangkatan = $key3['mulai_sk_pengangkatan'];
								$id_lembaga_pengangkatan = $key3['id_lembaga_pengangkatan'];
								$nama_lembaga_pengangkatan = $key3['nama_lembaga_pengangkatan'];
								$id_pangkat_golongan = $key3['id_pangkat_golongan'];
								$nama_pangkat_golongan = $key3['nama_pangkat_golongan'];
								$id_sumber_gaji = $key3['id_sumber_gaji'];
								$nama_sumber_gaji = $key3['nama_sumber_gaji'];
								$jalan = $key3['jalan'];
								$dusun = $key3['dusun'];
								$rt = $key3['rt'];
								$rw = $key3['rw'];
								$ds_kel = $key3['ds_kel'];
								$kode_pos = $key3['kode_pos'];
								$id_wilayah = $key3['id_wilayah'];
								$nama_wilayah = $key3['nama_wilayah'];
								$telepon = $key3['telepon'];
								$handphone = $key3['handphone'];
								$email = $key3['email'];
								$status_pernikahan = $key3['status_pernikahan'];
								$nama_suami_istri = $key3['nama_suami_istri'];
								$nip_suami_istri = $key3['nip_suami_istri'];
								$tanggal_mulai_pns = $key3['tanggal_mulai_pns'];
								$id_pekerjaan_suami_istri = $key3['id_pekerjaan_suami_istri'];
								$nama_pekerjaan_suami_istri = $key3['nama_pekerjaan_suami_istri'];
								

								
// 								$nama_mata_kuliah = $key3['nama_mata_kuliah'];
// 								$nama_mata_kuliah = ucwords(strtoupper(str_ireplace($cari_huruf, $huruf_baru, $nama_mata_kuliah)));
								
								
$insert = "INSERT INTO getdosen 
(id_dosen, nama_dosen, nidn, tanggal_lahir, tempat_lahir, nama_ibu_kandung, 
jenis_kelamin, id_agama, nama_agama, nip, nik, nama_jenis_sdm, 
no_sk_pengangkatan, nama_lembaga_pengangkatan, nama_wilayah, telepon, 
handphone, email, id_status_aktif, nama_status_aktif) VALUES 
('$id_dosen' ,'$nama_dosen','$nidn' ,'$tanggal_lahir' ,'$tempat_lahir' ,'$nama_ibu_kandung' ,
'$jenis_kelamin' ,'$id_agama' ,'$nama_agama' ,'$nip' ,'$nik' ,'$nama_jenis_sdm' ,
'$no_sk_pengangkatan' ,'$nama_lembaga_pengangkatan' ,'$nama_wilayah' ,'$telepon' ,
'$handphone' ,'$email' ,'$id_status_aktif' ,'$nama_status_aktif')";
// echo $insert;
mysqli_query($db ,$insert) or die(mysqli_error($db));




							}
					} //IF Key2
				}
			} //IF Key1

}}


echo $no." record";
$status =  "Get Data Terakhir Selesai";
progress($status,$act);



?>
