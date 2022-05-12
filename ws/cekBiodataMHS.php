<?php

ob_end_flush();
ob_implicit_flush();

  if (isset($_GET['error'])){$error = $_GET['error'];$error="and error='$error'";} else {
	  $error="and error is null"; $error="";}
  if (isset($_GET['awal'])){$awal  = $_GET['awal'];} else {$awal=1;}
  if (isset($_GET['akhir'])){$akhir  = $_GET['akhir'];} else {$akhir=102;}
  

$find = $nofind = 0;
$query = "SELECT * from cekmahasiswa where  id BETWEEN $awal AND $akhir $error and err='999' order by id ASC";
echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];
			$nim = $x['nim'];
			$nama = $x['nama_mahasiswa'];
			$tanggal_lahir = $x['Tanggal_Lahir'];
			$tanggal_lahir = date("d-m-Y", strtotime($tanggal_lahir));  
			// $filter = "nim='$nim'";
			$filter = "nama_mahasiswa='$nama' and tanggal_lahir='$tanggal_lahir' "; //cek berdasarkan nama

			$act = "GetBiodataMahasiswa";
			$request = $ws->prep_get($act,$filter,2,0);
			$ws_result = $ws->run($request);
			$ws->view($ws_result);
			$err_code = '0'; $err_desc='';
			if (isset($ws_result[1]["data"][0]["[id_mahasiswa]"])) {
				$id_mahasiswa = $ws_result[1]["data"][0]["[id_mahasiswa]"];	
			  } else {$id_mahasiswa = "-";}
			
			if (isset($ws_result[1]["data"][0]["nama_mahasiswa"])) {
				$mhs_result = $ws_result[1]["data"][0]["nama_mahasiswa"];
			} else {$nofind++; $mhs_result = "NIM Tidak Ditemukan"; $err_code = '999'; $err_desc='Tidak Ditemukan';}

$find++; 
$update = "UPDATE cekmahasiswa SET err='$err_code', descr='$err_desc' WHERE  id=$id";
mysqli_query($db, $update);
$statprogress = "
proses ke ".$id." -".$nim." - ". $id_mahasiswa." - ".$mhs_result."
Hasil
ditemukan : $find Mahasiswa
Tidak Ditemukan : $nofind Mahasiswa";
print_r($statprogress);
progress($statprogress,$act);

}

}else {
	echo "data tidak ditemukan";
}




?>
