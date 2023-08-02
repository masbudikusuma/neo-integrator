<?php
getPT($pt);
$idpt = $pt['id_pt'];

// $query = "SELECT * from insertmahasiswa where id < 11 ";
$query = "SELECT * from insertmahasiswa WHERE err_no is null or err_no NOT IN (0,200) order by id ASC";
// $query = "SELECT b.err, a.* from insertmahasiswa AS a  LEFT JOIN cekmahasiswa AS b ON a.nim = b.nim  where b.err='999' ";
// echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$nim = $x['nim'];
			
			$data = array(
			 'nama_mahasiswa' 	=> $x['nama_mahasiswa'], 
			 'tanggal_daftar' 	=> $x['tanggal_daftar'], 
			 'periode' 	=> $x['periode'], 
			 'jenis_kelamin' 	=> $x['jk'], 
			 'tempat_lahir' 	=> $x['Tempat_Lahir'], 
			 'tanggal_lahir' 	=> $x['Tanggal_Lahir'], 
			 'id_agama' 	=> $x['Agama'], 
			 'nik' 	=> $x['NIK'], 
			 'kewarganegaraan' 	=> $x['negara'], 
			 'kelurahan' 	=> $x['Kelurahan'], 
			 'id_wilayah' 	=> $x['ID_wilayah'], 
			 'id_wilayah' 	=> '000000', 
			 'nama_ibu_kandung' 	=> $x['ibu'], 
			 'Biaya_Masuk' 	=> $x['Biaya_Masuk'],
			 'penerima_kps' => 0,
			 'id_kebutuhan_khusus_mahasiswa' => 0, 
			 'id_kebutuhan_khusus_ayah' => 0,
			 'id_kebutuhan_khusus_ibu' => 0,
			 'nisn' => '1231231234',
			 'email' => 'pt@ac.id',
			 );
			//  print_r($data);
			 $act = "InsertBiodataMahasiswa";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			//  $ws->view($ws_result);                         
			 if(isset($ws_result[1]["error_code"])){
                         $err_code = $ws_result[1]["error_code"];
                         $err_desc = $ws_result[1]["error_desc"];
                         } else {
                         $err_code = $ws_result[1]["code"];
                         $err_desc = $ws_result[1]["message"];
                         }

			
			$update = "UPDATE insertmahasiswa SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
			mysqli_query($db, $update);

			
			log_insert($act,$data,$err_code,$err_desc);

			if($err_code == 0){
				$id_mahasiswa = $ws_result[1]["data"]["id_mahasiswa"];
				$update = "UPDATE insertmahasiswa SET err_no='$err_code', err_desc='$err_desc',Id_mahasiswa='$id_mahasiswa' WHERE  id=$id";
				mysqli_query($db, $update);
				echo $id_mahasiswa;
				$data = array(
					'id_mahasiswa' 	=> $id_mahasiswa, 
				    'nim' 	=> $x['nim'], 
					'id_prodi' 	=> $x['prodi_uuid'],
					'id_jenis_daftar' 	=> $x['Jenis_masuk'], 
					'tanggal_daftar' 	=> $x['tanggal_daftar'], 
					'id_periode_masuk' 	=> $x['periode'], 
                                        'biaya_masuk'   => $x['Biaya_Masuk'],
                                        'id_pembiayaan' => 1,
                                         'id_perguruan_tinggi' => $idpt
					);

				$act = "InsertRiwayatPendidikanMahasiswa";
				$request = $ws->prep_insert($act,$data);
				$ws_result = $ws->run($request);
				//  $ws->view($ws_result);
				$err_code = $ws_result[1]["error_code"];
				$err_desc = $ws_result[1]["error_desc"];
				
				
				// $update = "UPDATE insertmahasiswa SET err2_no='$err_code', err2_desc='$err_desc' WHERE  id=$id";
				// mysqli_query($db, $update);

				log_insert($act,$data,$err_code,$err_desc);
					if($err_code == 0){
						$id_registrasi_mahasiswa = $ws_result[1]["data"]["id_registrasi_mahasiswa"];
						$update = "UPDATE insertmahasiswa SET err2_no='$err_code', err2_desc='$err_desc', Id_reg_mahasiswa='$id_registrasi_mahasiswa' WHERE  id=$id";
						mysqli_query($db, $update);
						// print_r($id." - $nim ".$x['nama_mahasiswa']." , IDMHS : ". $id_mahasiswa." -, IDREG ".$id_registrasi_mahasiswa."\n");
						log_insert($act,$data,$err_code,$err_desc);}
					else {
						// print_r($id." - $nim ".$x['nama_mahasiswa']." , IDMHS : ". $id_mahasiswa." Error : ". $err_code." - ".$err_desc."\n");				
						$update = "UPDATE insertmahasiswa SET err2_no='$err_code', err2_desc='$err_desc' WHERE  id=$id";
						mysqli_query($db, $update);
						log_insert($act,$data,$err_code,$err_desc);
					}
			
			} 
			else if ($err_code == 200 || $err_code == 1209 ){
							cariidmhs($x['nama_mahasiswa'],$x['Tanggal_Lahir'],$id_mahasiswa);	
							// echo $id_mahasiswa;
							$update = "UPDATE insertmahasiswa SET err_no='$err_code', err_desc='$err_desc',Id_mahasiswa='$id_mahasiswa' WHERE  id=$id";
							mysqli_query($db, $update);
							// echo $id_mahasiswa;
							$data = array(
								'id_mahasiswa' 	=> $id_mahasiswa, 
								'nim' 	=> $x['nim'], 
								'id_prodi' 	=> $x['prodi_uuid'],
								'id_jenis_daftar' 	=> $x['Jenis_masuk'], 
								'tanggal_daftar' 	=> $x['tanggal_daftar'], 
								'id_periode_masuk' 	=> $x['periode'], 
								'biaya_masuk'   => $x['Biaya_Masuk'],
								'id_pembiayaan' => 1,
								'id_perguruan_tinggi' => $idpt
								);

							$act = "InsertRiwayatPendidikanMahasiswa";
							$request = $ws->prep_insert($act,$data);
							$ws_result = $ws->run($request);
							//  $ws->view($ws_result);
							$err_code = $ws_result[1]["error_code"];
							$err_desc = $ws_result[1]["error_desc"];
							
							
							// $update = "UPDATE insertmahasiswa SET err_no='$err_code', err_desc'$err_desc' WHERE  id=$id";
							// mysqli_query($db, $update);

							log_insert($act,$data,$err_code,$err_desc);
								if($err_code == 0){
									$id_registrasi_mahasiswa = $ws_result[1]["data"]["id_registrasi_mahasiswa"];
									$update = "UPDATE insertmahasiswa SET  err_desc='STEP1 : Berhasil', err2_no='$err_code', err2_desc='STEP2 : BERHASIL', Id_reg_mahasiswa='$id_registrasi_mahasiswa' WHERE  id=$id";
									mysqli_query($db, $update);
									// print_r($id." - $nim ".$x['nama_mahasiswa']." , IDMHS : ". $id_mahasiswa." -, IDREG ".$id_registrasi_mahasiswa."\n");
									log_insert($act,$data,$err_code,$err_desc);}
								else {
									$update = "UPDATE insertmahasiswa SET err2_no='$err_code', err2_desc='$err_desc' WHERE  id=$id";
									mysqli_query($db, $update);
									// print_r($id." - $nim ".$x['nama_mahasiswa']." , IDMHS : ". $id_mahasiswa." Error : ". $err_code." - ".$err_desc."\n");				
									log_insert($act,$data,$err_code,$err_desc);
								}
					// print_r($id." - $nim ".$x['nama_mahasiswa']." -[GAGAL Step2]- ". $err_code." - ".$err_desc."\n");				
			}
			else {
				// print_r($id." - $nim ".$x['nama_mahasiswa']." -[GAGAL Step2]- ". $err_code." - ".$err_desc."\n");				
				log_insert($act,$data,$err_code,$err_desc);
			}

// $update = "UPDATE InsertAKM SET error='$err_code', descr='$err_desc' WHERE  id=$id";
// mysqli_query($db, $update);
// print_r($id." - $nim ".$x['nama_mahasiswa']." - ". $err_code." - ".$err_desc);
// print_r($data);


}
}else {
	echo "data tidak ditemukan";
}

$status =  "Inject Terakhir Selesai";
progress($status,$act);


// echo "<script>window.close();</script>";

?>
