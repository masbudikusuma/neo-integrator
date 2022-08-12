<?php
// UPDATE insertpesertakelas as t1
// LEFT JOIN getmahasiswa AS t2 ON t2.nim = t1.nim
// SET  t1.id_registrasi_mahasiswa = t2.id_registrasi_mahasiswa
// WHERE t2.id_registrasi_mahasiswa IS NOT null;

//  #UPDATE insertpesertakelas as t1
//  #LEFT JOIN getkelaskuliah AS t2 ON t2.kode_mata_kuliah = t1.kode_mata_kuliah AND t2.nama_kelas_kuliah = t1.kode_kelas AND t2.id_semester = t1.semester
//  #SET  t1.id_kelas_kuliah = t2.id_kelas_kuliah
//  #WHERE t2.id_kelas_kuliah IS NOT null;


echo "Jangan Tutup Browser Ini Hingga Proses Selesai";

$query = "SELECT * from insertpesertakelas where err_no is null or err_no != '0' order by id ASC";
$no = 0;

$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
			$id = $x['id'];

			$data = array(
			 'id_kelas_kuliah' 	=> $x['id_kelas_kuliah'],
			 'id_registrasi_mahasiswa' 	=> $x['id_registrasi_mahasiswa'],
			);
			// print_r($data);
			$act = "InsertPesertaKelasKuliah";
			$request = $ws->prep_insert($act,$data);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

$err_code = $ws_result[1]["error_code"];
$err_desc = $ws_result[1]["error_desc"];
$no++;

if ($err_code == 0){
	$id_kelas_kuliah = $ws_result[1]["data"]["id_kelas_kuliah"];
	$status = "\n".$id." - : ".$err_code." - ".$err_desc;
	progress($status,$act);
	$update = "UPDATE InsertPesertaKelas SET err_no='$err_code', err_desc='$err_desc', res_id_registrasi_mahasiswa='".$id_kelas_kuliah."' WHERE  id=$id";
		mysqli_query($db, $update);
}else {
	$status = "\n".$id." - : ".$err_code." - ".$err_desc;
	$update = "UPDATE InsertPesertaKelas SET err_no='$err_code', err_desc='$err_desc' WHERE  id=$id";
		mysqli_query($db, $update);
	progress($status,$act);
}


}
}else {
	echo "data tidak ditemukan";
}
echo "<br><b>Jumlah Data :</b> ".$no." record";
$status =  "Inject Terakhir Selesai";
progress($status,$act);

// NOTE
// REspon "Ada kesalahan pada JSON yang dikirim" bukan berarti gagal,
// tapi terkadang ada data existing, harusnya munculnya data sudah ada

?>
