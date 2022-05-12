<?php
echo "Jangan Tutup Browser Ini Hingga Proses Selesai";

$query = "SELECT * from insertnilaikuliahkelas where err_no is null or err_no != '0' order by id ASC";
$no = 0;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			
			$data = array(
		'id_registrasi_mahasiswa'   => $x['id_registrasi_mahasiswa'],
		'id_kelas_kuliah' => $x['id_kelas'],
		'nilai_angka'   	=> $x['nilai_angka'],
		'nilai_huruf'   	=> $x['nilai_huruf'],
		'nilai_indeks'   	=> $x['nilai_indeks'],
					);
					print_r($data);echo "<br>";
			
			$keys = array(
				'id_registrasi_mahasiswa'   => $x['id_registrasi_mahasiswa'],
		'id_kelas_kuliah' => $x['id_kelas'],
			   );
			   $act = "UpdateNilaiPerkuliahanKelas";
			$request = $ws->prep_update($act,$keys,$data);
			// $request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			 $ws->view($ws_result);echo "<br>";
$no++;
$err_no = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_no == 0){
	$id_registrasi_mahasiswa = $ws_result[1]["data"]["id_reg_pd"];
	$progress= "\n".$id." - ID Kelas Kuliah : ".$id_registrasi_mahasiswa;
	$update = "UPDATE insertnilaikuliahkelas 
		SET err_no='".$err_no."' WHERE  id=".$id.";";
		echo $update;
	mysqli_query($db, $update);
	progress($progress,$act);
}else {
	$progress = "\n".$id." - : ".$err_no." - ".$err_desc;
	$update = "UPDATE insertnilaikuliahkelas 
		SET `err_no`='".$err_no."', `err_desc`='".$err_desc."' WHERE  id=".$id.";";
	mysqli_query($db, $update);
	progress($progress,$act);
}


}
}else {
	echo "data tidak ditemukan";
}
echo "<br><b>Jumlah Data :</b> ".$no." record";
$status =  "Inject Terakhir Selesai";
progress($status,$act);

?>
