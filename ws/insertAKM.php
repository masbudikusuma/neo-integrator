<?php
echo "Jangan Tutup Browser Ini Hingga Proses Selesai"; 

$query = "SELECT * from insertakm where  err_no is null or err_no != '0' order by id ASC";
echo $query;
$hasil = mysqli_query($db, $query);
$jmlmhs = mysqli_num_rows($hasil);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$nama_mahasiswa = $x['nama_mahasiswa'];
			$nim = $x['nim'];
			$nim = $x['nim'];
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

	$inserdb = "INSERT INTO getakm 
(id_registrasi_mahasiswa, nama_mahasiswa, nim, id_prodi, 
nama_program_studi, angkatan, id_semester, nama_semester, 
id_status_mahasiswa, nama_status_mahasiswa, ips, ipk, 
sks_semester, sks_total, biaya_kuliah_smt) VALUES 
('$id_registrasi_mahasiswa', '$nama_mahasiswa', '$nim', 'methode insert', 
'methode insert', 'methode insert', '$id_semester', 'methode insert', 
'$id_status_mahasiswa', 'methode insert', '$ips', '$ipk', 
'$sks_semester', '$total_sks', '$biaya_kuliah_smt');
";
// echo $inserdb;
mysqli_query($db ,$inserdb) or die(mysqli_error($db));


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
