<?php
echo "Jangan Tutup Browser Ini Hingga Proses Selesai";
$query = "SELECT * from insertmahasiswalulusdo where err_no is null or err_no != '0' order by id ASC";
// echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
						
			// $id_kelas_kuliah = $x['id_kelas_kuliah'];
			if (isset($_GET['tipe'])){$tipe = $_GET['tipe'];} else {$tipe="lengkap";}

			switch ($tipe) {
				case "minim":
					$data = array(
						'id_registrasi_mahasiswa' => $x['id_reg_mahasiswa'],
						'id_jenis_keluar' => $x['id_jenis_keluar'],
						'tanggal_keluar' =>  $x['tanggal_keluar'],
						'id_periode_keluar' => $x['id_periode_keluar'],
						'ipk' => $x['ipk'],
						'nomor_ijazah' =>  $x['nomor_ijazah'],
					);
				  break;


				default:
				  $data = array(
					'id_registrasi_mahasiswa' => $x['id_reg_mahasiswa'],
					'id_jenis_keluar' => $x['id_jenis_keluar'],
					'tanggal_keluar' =>  $x['tanggal_keluar'],
					'id_periode_keluar' => $x['id_periode_keluar'],
					'keterangan' => $x['keterangan'],
					'nomor_sk_yudisium' => $x['nomor_sk_yudisium'],
					'tanggal_sk_yudisium' => $x['tanggal_sk_yudisium'],
					'ipk' => $x['ipk'],
					'nomor_ijazah' =>  $x['nomor_ijazah'],
					'jalur_skripsi' => $x['jalur_skripsi'],
					'judul_skripsi' => $x['judul_skripsi'],	
				);	
				}
			
			// print_r($data);
			$act = "InsertMahasiswaLulusDO";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_registrasi_mahasiswa = $ws_result[1]['data']["id_registrasi_mahasiswa"];
	$update = "UPDATE insertmahasiswalulusdo SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	$statprogress = "<br>".$id.". ".$id_registrasi_mahasiswa;
	print_r($statprogress);
	progress($statprogress,$act);

}else {
	$update = "UPDATE insertmahasiswalulusdo SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	$statprogress = "<br>".$id." - ".$err_code." - ".$err_desc;
	print_r($statprogress);
	progress($statprogress,$act);
}


}
}else {
	echo "data tidak ditemukan";
}

$status =  "Inject Terakhir Selesai";
progress($status,$act);


echo "<script>window.close();</script>";
?>
