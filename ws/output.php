<?php
// 	require_once "ws_pddikti.php";
// 	require_once "config.php";
// 	require_once "function.php";
// ob_end_flush();
// ob_implicit_flush();

if (isset($_GET['mod'])){
	$fungsi  = $_GET['mod'];
	} else {$fungsi="GetCountKelasKuliah";}

$filter = "";
$limit = 10;
$order = 0;
$request = $ws->prep_get($fungsi,$filter,$limit,$order);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);


// CEK FUNGSI
// $nim = "1903017025";
// $filter = "nim='$nim'"; //cek berdasarkan NIM
// $request = $ws->prep_get('GetListMahasiswa',$filter,1,0);
// $ws_result = $ws->run($request);
// // $ws->view($ws_result);
// if (isset($ws_result[1]["data"][0]["id_registrasi_mahasiswa"])) {
// 	$id_reg_mhs = $ws_result[1]["data"][0]["id_registrasi_mahasiswa"];	
// 	$nama_status_mahasiswa = $ws_result[1]["data"][0]["nama_status_mahasiswa"];	
// 	$nama_program_prodi = $ws_result[1]["data"][0]["nama_program_studi"];	
// 	$jenis_kelamin = $ws_result[1]["data"][0]["jenis_kelamin"];	
// 	$tanggal_lahir = $ws_result[1]["data"][0]["tanggal_lahir"];	
// 	$nama = $ws_result[1]["data"][0]["nama_mahasiswa"];	
// 	// $nama = $ws_result[1]["data"][0]["nama_mahasiswa"];	
// 	// $nama = $ws_result[1]["data"][0]["nama_mahasiswa"];	
// 	echo "ditemukan";
// 	} else {
// 		$id_reg_mhs=$nama = "Tidak Ditemukan";
// 		echo "tidak ditemukan";
		
// 	}  


// $nama = "Ulfatun Hasanah"; 
// $tgl = "1994-12-31";
// cariidmhs($nama,$tgl,$id_mahasiswa);	
// echo $id_mahasiswa;
// $id_reg_mhs=$nama = "-";

// $nim = $id_reg_mhs = $nama = $jk=$tl =$prodi = $status=$baris[0];
// $tanggalkeluar = date("Y-m-d", strtotime($baris[2]));
// caribiomhs($nim,$nama,$jk,$tl,$prodi,$status);
// cariidregmhs($nim,$id_reg_mhs,$nama);
// echo $id_reg_mhs;
// echo $nama;
// $kodemk = "PS-2101";
// $kodekelas   ="2KPI1";
// $semester = "20161";
// $id_kelas_kuliah ="";
// carikelas($kodemk,$kodekelas,$semester,$id_kelas_kuliah);
// echo $id_kelas_kuliah;


?>
