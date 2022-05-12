<?php

echo "Jangan Tutup Browser Ini Hingga Proses Selesai";

$query = "SELECT * from updatemahasiswa where err_no is null or err_no != '0' order by id ASC";
$no = 0;
  
$hasil = mysqli_query($db, $query);
$jmlmhs = mysqli_num_rows($hasil);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$id_registrasi_mahasiswa = $x['id_reg_mahasiswa'];
			$id_mahasiswa = $x['id_mahasiswa'];
			$method = $x['method'];
			$dataupdate = $x['data'];
			$dataupdate = trim(preg_replace('/\s\s+/', '', $dataupdate));

			$data = array(
			 $method => $dataupdate,
			);
			$keys = array(
				'id_mahasiswa' 	=> $id_mahasiswa,
			   );
			// print_r($data);
			$act = "UpdateBiodataMahasiswa";
			$request = $ws->prep_update($act,$keys,$data);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];
$no++;
if ($err_code == 0){
	// $id_registrasi_mahasiswa = $ws_result[1]['data']["id_registrasi_mahasiswa"];
	$update = "UPDATE updatemahasiswa SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	// echo $update;
	$statprogress = "\n".$id.". ".$id_registrasi_mahasiswa." data $id dari $jmlmhs";
	// print_r($statprogress);
	progress($statprogress,$act);

}else {
	$update = "UPDATE updatemahasiswa SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
	mysqli_query($db, $update);
	// echo $update;
	$statprogress = "\n".$id." - ".$err_code." - ".$err_desc." data $id dari $jmlmhs";
	// print_r($statprogress);
	progress($statprogress,$act);
}

}
}else {
	echo "data tidak ditemukan";
}

echo "<br><b>Jumlah Data :</b> ".$no." record";
$status =  "Inject Terakhir Selesai";
progress($status,$act);





?>
