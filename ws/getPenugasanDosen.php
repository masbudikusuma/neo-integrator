<?php

$act = "GetDetailPenugasanDosen";
$limit = "";
$no = 0;
$request = $ws->prep_get($act,"",$limit,0);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);

			$kosongkantabel = "TRUNCATE getPenugasanDosen;";
			mysqli_query($db ,$kosongkantabel);

			if ($ws_result[1]["error_code"] == 0) {

						foreach ($ws_result as $key){
							if (is_array($key)){
							foreach ($key as $key2){
								if (is_array($key2)){
										foreach ($key2 as $key3){
											$nama_dosen	= hapus_tanda($key3['nama_dosen']);
											$id_registrasi_dosen = $key3['id_registrasi_dosen'];
											$id_dosen = $key3['id_dosen'];
											$nidn = $key3['nidn'];
											$id_tahun_ajaran = $key3['id_tahun_ajaran'];
											$nama_tahun_ajaran = $key3['nama_tahun_ajaran'];
											$id_perguruan_tinggi = $key3['id_perguruan_tinggi'];
											$nama_perguruan_tinggi = $key3['nama_perguruan_tinggi'];
											$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
											$id_prodi = $key3['id_prodi'];
											$tanggal_surat_tugas = date("Y-m-d", strtotime($key3['tanggal_surat_tugas']));  
											$mulai_surat_tugas = date("Y-m-d", strtotime($key3['mulai_surat_tugas']));  
											$nomor_surat_tugas = date("Y-m-d", strtotime($key3['nomor_surat_tugas']));  
											$no++;
										// echo $no.' '.$id_aktivitas_mengajar.' '.$nama_dosen;

										$inserdb = "INSERT INTO getPenugasanDosen (id_registrasi_dosen, id_dosen,
											 nama_dosen, nidn, id_tahun_ajaran,nama_tahun_ajaran,
											 id_perguruan_tinggi,nama_perguruan_tinggi,id_prodi,
											 nama_program_studi,nomor_surat_tugas,tanggal_surat_tugas,mulai_surat_tugas)
										VALUES ('$id_registrasi_dosen', '$id_dosen',
											 '$nama_dosen', '$nidn', '$id_tahun_ajaran','$nama_tahun_ajaran',
											 '$id_perguruan_tinggi', '$nama_perguruan_tinggi', '$id_prodi',
											 '$nama_program_studi', '$nomor_surat_tugas', '$tanggal_surat_tugas', '$mulai_surat_tugas')";
										// echo $inserdb;
										mysqli_query($db ,$inserdb) or die(mysqli_error($db));

										$statprogress = "\n".$no.". ".$nama_dosen." - ".$nama_program_studi;
										// print_r($statprogress);
										progress($statprogress,$act);
										echo $buffer.".";
										ob_flush();
										flush();

										}
								} //IF Key2
							}
						} //IF Key1

}}

// DELETE PESERTA KELAS KULIAH
// $query = "SELECT * from Feeder_Peserta_Kelas_Kuliah where  id BETWEEN $awal AND $akhir GROUP BY id_kelas_kuliah  order by id ASC";
// // SELECT * from Feeder_Peserta_Kelas_Kuliah where error is null and id BETWEEN $awal AND $akhir order by id ASC ";
// $hasil = mysqli_query($db, $query);
// if(mysqli_num_rows($hasil) > 0 ){
// while($x = mysqli_fetch_array($hasil)){
// 			$id = $x['id'];
// 			$id_kelas_kuliah = $x['id_kelas_kuliah'];
// 			$id_reg_mahasiswa = $x['id_reg'];
//
// 			$data = array(
// 			 'id_kelas_kuliah' 	=> $id_kelas_kuliah
// 			);
// 			$request = $ws->prep_delete("DeleteKelasKuliah",$data);
// 			$ws_result = $ws->run($request);
// 			// $ws_result = $ws->view($result);
//
// $err_code = $ws_result[1]["error_code"];
// $err_desc = $ws_result[1]["error_desc"];
//
// $update = "UPDATE Feeder_Peserta_Kelas_Kuliah SET error_kelas='$err_code',
// descr_kelas='$err_desc' WHERE  id=$id";
// mysqli_query($db, $update);
// print_r($id." - ". $err_code." - ".$err_desc);
//
//
// }
// }else {
// 	echo "data tidak ditemukan";
// }





?>
