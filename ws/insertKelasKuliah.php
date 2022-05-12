<?php
// echo "Jangan Tutup Browser Ini Hingga Proses Selesai <br>"; 

$query = "SELECT * from insertKelasKuliah where  err_no is null or err_no != '0' order by id ASC";
$no = 0;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];

			if (isset($_GET['tipe'])){$tipe = $_GET['tipe'];} else {$tipe="lengkap";}
			$tanggal_mulai_efektif = date("Y-m-d", strtotime($x['tanggal_mulai_efektif']));
			$tanggal_akhir_efektif = date("Y-m-d", strtotime($x['tanggal_akhir_efektif']));
			$tanggal_tutup_daftar = date("Y-m-d", strtotime($x['tanggal_tutup_daftar']));
			switch ($tipe) {
				case "minim":
					$data = array(
						'id_prodi' =>$x['id_prodi'],
						'id_semester' =>$x['id_semester'],
						'id_matkul' =>$x['id_matkul'],
						'nama_kelas_kuliah' =>$x['nama_kelas_kuliah'],
						'tanggal_mulai_efektif' =>$tanggal_mulai_efektif, //yyyy-mm-dd
						'tanggal_akhir_efektif' =>$tanggal_akhir_efektif,
						'lingkup' =>$x['lingkup'], //1: Internal, 2: External, 3: Campuran
						'mode' =>$x['mode'], //O: Online, F: Offline, M: Campuran
					);
					// print_r($data);
				  break;

				  default:
				  $data = array(
					'id_prodi' =>$x['id_prodi'],
					'id_semester' =>$x['id_semester'],
					'id_matkul' =>$x['id_matkul'],
					'nama_kelas_kuliah' =>$x['nama_kelas_kuliah'],
					'bahasan' =>$x['bahasan'],
					'tanggal_mulai_efektif' =>$x['tanggal_mulai_efektif'], //yyyy-mm-dd
					'tanggal_akhir_efektif' =>$x['tanggal_akhir_efektif'],
					'tanggal_tutup_daftar' =>$x['tanggal_tutup_daftar'],
					'kapasitas' =>$x['kapasitas'],
					'lingkup' =>$x['lingkup'], //1: Internal, 2: External, 3: Campuran
					'mode' =>$x['mode'], //O: Online, F: Offline, M: Campuran
				   );
				}
				$kodemk =$x['kodemk'];
			$act = "InsertKelasKuliah";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			 $ws->view($ws_result);
$no++;
$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];

if ($err_code == 0){
	$id_kls = $ws_result[1]["data"]["id_kelas_kuliah"];
	
	$update = "UPDATE insertkelaskuliah 
		SET err_no='".$err_code."', err_desc='".$err_desc."', id_kelas_kuliah='".$id_kls."' WHERE  id=".$id.";";
		mysqli_query($db, $update);
	// $progress = "\n".$id." - ID Kelas Kuliah : ".$id_kls;
	$id_key = $id_key= $x['id_semester']."_".$x['nama_kelas_kuliah']."_".$x['kodemk']."_".$x['id_prodi'];;
	$inserdb = "INSERT IGNORE INTO getkelaskuliah 
(id_kelas_kuliah, id_prodi, id_semester, id_matkul, kode_mata_kuliah, 
nama_mata_kuliah, nama_kelas_kuliah, id_key, nama_program_studi) VALUES 
('$id_kls', '".$x['id_prodi']."', '".$x['id_semester']."', '".$x['id_matkul']."', '".$x['kodemk']."', 
'".$x['namamk']."', '".$x['nama_kelas_kuliah']."', '$id_key', '".$x['nama_prodi']."');";
mysqli_query($db ,$inserdb) or die(mysqli_error($db));

	progress($progress,$act);
	echo $buffer.".";
		ob_flush();
		flush();
}else {
	
	$update = "UPDATE insertkelaskuliah 
	SET err_no='".$err_code."', err_desc='".$err_desc."' WHERE  id=".$id.";";
	mysqli_query($db, $update);
	$progress = "\n".$id." - : ".$err_code." - ".$err_desc;
	progress($progress,$act);
	echo $buffer."e";
ob_flush();
flush();
	}


}
}else {
	echo "data tidak ditemukan";
}

echo "<br><b>Jumlah Data :</b> ".$no." record";
$status =  "Insert Data Terakhir Selesai";
progress($status,$act);


?>
