<?php
echo "Jangan Tutup Browser Ini Hingga Proses Selesai"; 

$query = "SELECT * from InsertAKM where  err_no is null or err_no != '0' order by id ASC";
$hasil = mysqli_query($db, $query);
$jmlmhs = mysqli_num_rows($hasil);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$id_registrasi_mahasiswa = $x['id_registrasi_mahasiswa'];
			$id_semester = $x['id_semester'];
			$id_status_mahasiswa = $x['id_status_mahasiswa'];
			$ips = $x['ips'];
			$ipk = $x['ipk'];
			$sks_semester = $x['sks_semester'];
			$total_sks = $x['total_sks'];
			$biaya_kuliah_smt = $x['biaya_kuliah_smt'];

			// $id_kelas_kuliah = $x['id_kelas_kuliah'];
			$data = array(
			 'id_registrasi_mahasiswa' 	=> $id_registrasi_mahasiswa,
			 'id_semester' 	=> $id_semester,
			 'id_status_mahasiswa' 	=> $id_status_mahasiswa,
			 'ips' 	=> $ips,
			 'ipk' 	=> $ipk,
			 'sks_semester' 	=> $sks_semester,
			 'total_sks' 	=> $total_sks,
			 'biaya_kuliah_smt' 	=> $biaya_kuliah_smt
			);
			// print_r($data);
			// print_r("data : ".$data)  ;

			$key = array(
				'id_registrasi_mahasiswa' 	=> $id_registrasi_mahasiswa,
				'id_semester' 	=> $id_semester,
			   );
			//  print_r($key)  ;

			 $act = "InsertPerkuliahanMahasiswa";
			$request = $ws->prep_insert($act,$data);

			// $act = "UpdatePerkuliahanMahasiswa";
			// $request = $ws->prep_update($act,$key,$data);

			// $act = "DeletePerkuliahanMahasiswa";
			// $request = $ws->prep_delete($act,$key);
			
			
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_registrasi_mahasiswa = $ws_result[1]['data']["id_registrasi_mahasiswa"];
	$update = "UPDATE insertakm SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	// print_r();
	$statprogress = "\n".$id.". ".$x['id_registrasi_mahasiswa']." (data $id dari $jmlmhs)";
	// print_r($statprogress);
	echo ".";
	progress($statprogress,$act);

}else {
	$update = "UPDATE insertakm SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	$statprogress = "\n".$id." - ".$err_code." - ".$err_desc." (data $id dari $jmlmhs)";
	print_r($statprogress);
	echo "-E-";
	progress($statprogress,$act);
}

}
}else {
	echo "data tidak ditemukan";
}
$status =  "Inject Terakhir Selesai";
progress($status,$act);
// echo "<script>window.close();</script>";


?>
