<?php
function biodata($result,&$respon){
if ($result[1]["error_code"] == 0) {
foreach ($result as $key){
if (is_array($key)){
foreach ($key as $key2){
if (is_array($key2)){
foreach ($key2 as $key3){
$nama = $key3['nama_mahasiswa']; $tempat_lahir = $key3['tempat_lahir'];
$tanggal_lahir = $key3['tanggal_lahir']; $agama = $key3['nama_agama'];
$ibu = $key3['nama_ibu_kandung']; $jk = $key3['jenis_kelamin'];
$respon =  "Nama   : $nama
Tempat Lahir : $tempat_lahir
Tanggal Lahir : $tanggal_lahir
Jenis Kelamin : $jk
Nama Ibu : $ibu
Agama : $agama
";
}} }} }}else {
$respon = "data idmhs tidak ditemukan";
}
}

// =======================================================
function cari_idmhs($result,&$respon){
if ($result[1]["error_code"] == 0) {
foreach ($result as $key){
if (is_array($key)){
foreach ($key as $key2){
if (is_array($key2)){
foreach ($key2 as $key3){
$respon = $id_mhs = $key3['id_mahasiswa'];
}} }} }}else {
$respon = "data idmhs tidak ditemukan";
}}

// =======================================================
function riwayatpendidikan($ws,$id_mahasiswa,&$respon,&$id_registrasi_mahasiswa){
$request = $ws->prep_get("GetListRiwayatPendidikanMahasiswa","id_mahasiswa='$id_mahasiswa'");
$result = $ws->run($request);
if ($result[1]["error_code"] == 0) {
foreach ($result as $key){
if (is_array($key)){
foreach ($key as $key2){
if (is_array($key2)){
foreach ($key2 as $key3){
$nim = $key3['nim']; $nama = $key3['nama_mahasiswa'];
$jenis_daftar = $key3['nama_jenis_daftar']; $periode_masuk = $key3['nama_periode_masuk'];
$tanggal_daftar = $key3['tanggal_daftar']; $keterangan_keluar = $key3['keterangan_keluar'];
$pt = $key3['nama_perguruan_tinggi']; $prodi = $key3['nama_program_studi'];
$biaya_masuk = $key3['biaya_masuk'];
$respon = "Nama   : $nama
nim : $nim
Program Studi : $prodi
Perguruan Tinggi : $pt
Periode Masuk : $periode_masuk
Tanggal Masuk : $tanggal_daftar
Jenis Daftar : $tanggal_daftar
Jenis Keluar : $keterangan_keluar
Biaya Masuk : $biaya_masuk
";
}} }} }}else {
$respon = "data idmhs tidak ditemukan";
}
}


function log_insert($act,$data_insert,$error_no,$error_desc){  
require "config.php";  
$data_insert = serialize($data_insert); 
$insert = "INSERT INTO log_insert (act, data, error, error_desc) VALUES 
('$act', '$data_insert', '$error_no', '$error_desc');";
mysqli_query($db, $insert);
    }

function get_token(&$token){    
    require "config.php"; 
    $data = '{   "act" : "GetToken",
        "username" : "'.$userfeeder.'",
        "password" : "'.$passfeeder.'"}';
        $curlfeeder = curl_init();
        curl_setopt_array($curlfeeder, array(
        CURLOPT_URL => $urlfeeder."/ws/live2.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array("content-type: application/json",),
        ));
      
        $response = curl_exec($curlfeeder);
        $respon = utf8_encode($response);
        $token = json_decode($respon, true);

        if($token['error_code'] == 0) {$token = $token['data']['token'];} else
        {$token=$token['error_desc'];}
        // print($token); 
    }

function getPT(&$pt){
    // $GetProfilPT='';
    require "config.php"; 
    $request = $ws->prep_get('GetProfilPT');
			$ws_result = $ws->run($request);
if ($ws_result[1]["error_code"] == 0) {
    foreach ($ws_result as $key){
        if (is_array($key)){  foreach ($key as $key2){
        if (is_array($key2)){  foreach ($key2 as $key3){
                        $cari_huruf = array("'",'&amp;','&copy;','&crarr;','&dArr;','&deg;','&divide;','&eacute;','&fnof;','&frasl;','&ge;','&harr;','&hArr;','&hellip;','&larr;','&lArr;','&ldquo;','&le;','&lowast;','&lsquo;','&mdash;','&nbsp;','&ndash;','&ne;','&plusmn;','&prime;','&Prime;','&quot;','&rarr;','&rArr;','&rdquo;','&reg;','&rsquo;','&sect;','&sum;','&times;','&uarr;','&uArr;','&lt;br /&gt;','&lt;','&gt;','%','&check;','&raquo;','&laquo;');
                        $huruf_baru = array("",'&','©','?','?','°','÷','é','ƒ','?','?','?','?','…','?','?','“','?','?','','','','-','?','±','?','?','"','?','?','','®','','§','?','×','?','?','','<','>',"","✓",">>","<<");													
                        $pt = array();
                        $pt['id_pt'] = $key3['id_perguruan_tinggi'];
                        $pt['kode_pt'] = $key3['kode_perguruan_tinggi'];
                        $pt['nama_pt'] = $key3['nama_perguruan_tinggi'];
                        $pt['telp'] = $key3['telepon'];
                        $pt['faximile'] = $key3['faximile'];
                        $pt['email'] = $key3['email'];
                        $pt['sk_pendirian'] = $key3['sk_pendirian'];
                        $pt['nama_wilayah'] = $key3['nama_wilayah'];
                        $pt['tanggal_sk_pendirian'] = $key3['tanggal_sk_pendirian'];
                        $pt['website'] = $key3['website'];
        } } //IF Key2
        } } //IF Key1
    } } }

    function hapus_tanda(&$string){
        $cari_huruf = array("'",'&amp;','&copy;','&crarr;','&dArr;','&deg;','&divide;','&eacute;','&fnof;','&frasl;','&ge;','&harr;','&hArr;','&hellip;','&larr;','&lArr;','&ldquo;','&le;','&lowast;','&lsquo;','&mdash;','&nbsp;','&ndash;','&ne;','&plusmn;','&prime;','&Prime;','&quot;','&rarr;','&rArr;','&rdquo;','&reg;','&rsquo;','&sect;','&sum;','&times;','&uarr;','&uArr;','&lt;br /&gt;','&lt;','&gt;','%','&check;','&raquo;','&laquo;',"'");
        $huruf_baru = array("",'&','©','?','?','°','÷','é','ƒ','?','?','?','?','…','?','?','“','?','?','','','','-','?','±','?','?','"','?','?','','®','','§','?','×','?','?','','<','>',"","✓",">>","<<","");
        return ucwords(strtoupper(str_ireplace($cari_huruf, $huruf_baru, $string)));

    }

?>
