<?php
	require_once "ws_pddikti.php";
	require_once "config.php";
	require_once "function.php";
	ob_end_flush();
  ob_implicit_flush();

  if (isset($_GET['error'])){$error = $_GET['error'];$error="and error='$error'";} else {$error="and error is null";}
  if (isset($_GET['awal'])){$awal  = $_GET['awal'];} else {$awal=1;}
  if (isset($_GET['akhir'])){$akhir  = $_GET['akhir'];} else {$akhir=2;}


// Metode WS
$query = "SELECT * from getprodi limit 100";
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			
			 $id_prodi 	= $x['id_prodi'];
			 $nama_prodi 	= $x['nama_program_studi'];
			 $id_semester = '20211';
			 $jumlah_target_mahasiswa_baru = "100";
			 $jumlah_pendaftar_ikut_seleksi = 100;
			 $jumlah_pendaftar_lulus_seleksi = 100;
			 $jumlah_daftar_ulang = 100;
			 $jumlah_mengundurkan_diri = "0";
			 $jumlah_minggu_pertemuan = 16;
			 $tanggal_awal_perkuliahan = "2021-07-01";
			 $tanggal_akhir_perkuliahan = "2021-12-30";

			$data = array(
			 'id_prodi' 	=> $id_prodi,
			 'id_semester' 	=> $id_semester,
			 'jumlah_target_mahasiswa_baru' 	=> $jumlah_target_mahasiswa_baru,
			 'jumlah_pendaftar_ikut_seleksi' 	=> $jumlah_pendaftar_ikut_seleksi,
			 'jumlah_pendaftar_lulus_seleksi' 	=> $jumlah_pendaftar_lulus_seleksi,
			 'jumlah_daftar_ulang' 	=> $jumlah_daftar_ulang,
			 'jumlah_mengundurkan_diri' 	=> $jumlah_mengundurkan_diri,
			 'jumlah_minggu_pertemuan' 	=> $jumlah_minggu_pertemuan,
			 'tanggal_awal_perkuliahan' 	=> $tanggal_awal_perkuliahan,
			 'tanggal_akhir_perkuliahan' 	=> $tanggal_akhir_perkuliahan
			 
			);
			$act = "InsertBiodataMahasiswa";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			// $ws_result = $ws->view($result);
			// print_r($data);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

// $update = "UPDATE InsertPesertaKelas SET error='$err_code', descr='$err_desc' WHERE  id=$id";
// mysqli_query($db, $update);
print_r($id." $nama_prodi - ". $err_code." - ".$err_desc);

log_insert($act,$data,$err_code,$err_desc);

}
}else {
	echo "data Prodi TIdak Ditemukan, Silhkan Tarik Program studi Dulu";
}

// Metode URL+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++==
// $query = "SELECT * from getprodi limit 3";
// $hasil = mysqli_query($db, $query);
// if(mysqli_num_rows($hasil) > 0 ){
// while($x = mysqli_fetch_array($hasil)){
// 			$id = $x['id'];
			
// 			 $id_prodi 	= $x['id_prodi'];
// 			 $nama_prodi 	= $x['nama_program_studi'];
// 			 $id_semester = '20212';
// 			 $jumlah_target_mahasiswa_baru = "100";
// 			 $jumlah_pendaftar_ikut_seleksi = 100;
// 			 $jumlah_pendaftar_lulus_seleksi = 100;
// 			 $jumlah_daftar_ulang = 100;
// 			 $jumlah_mengundurkan_diri = "0";
// 			 $jumlah_minggu_pertemuan = 16;
// 			 $tanggal_awal_perkuliahan = 16;
// 			 $tanggal_awal_perkuliahan = 16;

// 			 $data = '{"target_mhs_baru":"'.jumlah_target_mahasiswa_baru.'",
// 				"calon_ikut_seleksi":"'.jumlah_pendaftar_ikut_seleksi.'",
// 				"calon_lulus_seleksi":"'.jumlah_pendaftar_lulus_seleksi.'",
// 				"daftar_sbg_mhs":"'.jumlah_daftar_ulang.'",
// 				"jml_mgu_kul":"'..'",
// 				"pst_undur_diri":"'.jumlah_mengundurkan_diri.'",
// 				"tgl_awal_kul":"'..'",
// 				"tgl_akhir_kul":"'.tanggal_awal_perkuliahan.'",
// 				"id_sms":"'.$id_prodi.'",
// 				"id_smt":"'.tanggal_awal_perkuliahan.'"}';
// 				$curlfeeder = curl_init();
// 				curl_setopt_array($curlfeeder, array(
// 				CURLOPT_URL => $urlfeeder."/ws/live2.php",
// 				CURLOPT_RETURNTRANSFER => true,
// 				CURLOPT_TIMEOUT => 30,
// 				CURLOPT_CUSTOMREQUEST => "POST",
// 				CURLOPT_POSTFIELDS => $data,
// 				CURLOPT_HTTPHEADER => array("content-type: application/json",),
// 				));
			  
// 				$response = curl_exec($curlfeeder);
// 				$respon = utf8_encode($response);
// 				$token = json_decode($respon, true);
		
// 				if($token['error_code'] == 200) {$token = $token['data']['token'];} else
// 				{$token=$token['error_desc'];}

				
// $err_code = $ws_result[1]["error_code"];
// $err_desc = $ws_result[1]["error_desc"];

// // $update = "UPDATE InsertPesertaKelas SET error='$err_code', descr='$err_desc' WHERE  id=$id";
// // mysqli_query($db, $update);
// print_r($id." $nama_prodi - ". $err_code." - ".$err_desc);

// log_insert($act,$data,$err_code,$err_desc,$db);

// }
// }else {
// 	echo "data Prodi TIdak Ditemukan, Silhkan Tarik Program studi Dulu";
// }



?>
