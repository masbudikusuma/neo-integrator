<?php 
// $module="Akmimport";
$ModuleName = "MAHASISWA BARU";
$table = "insertmahasiswa";
$link1 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=tambah'; //tambah data
$link2 = "index.php?module=inject&act=".$module; //Lihat Data / Lanjutkan Sync
$link3 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=kosongkan'; // Kosongkan Data 
$link4 = $_SERVER['PHP_SELF'] . '?module=inject&act='.$module ; // PAGE SYNCRON KE FEEDER
$cancel = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=cancel&insertid='.$insertid; //  Cancel
if (isset($_GET['insertid'])){$deleteinsert=$_GET['insertid'];}else{$deleteinsert=null;}
// ACT DETECT
if (isset($_GET['aksi']))
{
    $aksi = $_GET['aksi'];
    switch ($_GET['aksi'])
    {
        case "cancel":
            $clear_temp = "DELETE FROM ".$table." WHERE  insertid='$deleteinsert';";
            mysqli_query($db, $clear_temp);
        break;

        case "kosongkan":
            $clear_temp = "TRUNCATE ".$table;
            mysqli_query($db, $clear_temp);
        break;
        
        case "tambah";
        break;
        default:
            echo $_GET['aksi'] . "Aksi Tidak ditemukan";

    }
} else {$aksi = null;}
// Cek Data EXisting
$query = "select * from ".$table;
$berhasil=$sudahada=$gagal=$belum=0;
$hasil = mysqli_query($db, $query);
$jmldata = mysqli_num_rows($hasil);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
    if ( is_null($x['err_no']) ){$belum++;}
    else if ($x['err_no'] == 0 ){$berhasil++;}
    else{$gagal++;}
}
}


?>
<div class="content-wrapper container">

<div class="page-content">
    <section class="row">

    <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
<!----------------- OPSI TEXT ------------------------------->
                                <div class="tab-pane fade show active" id="list-TEXT" role="tabpanel" aria-labelledby="list-TEXT-list">
                                    <h4 class="card-title">IMPORT DATA <?php echo $ModuleName;?></h4>
                                <ul class="pagination pagination-primary  justify-content-center">                      
                                <div class="buttons justify-content-center">    
                                    <div class="modal-success me-1 mb-1 d-inline-block"><br>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success">
                                    PETUNJUK PENGGUNAAN
                                    </button>
                                    <!--Success theme Modal -->
                                    <div class="modal fade text-left" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success">
                                                    <h5 class="modal-title white" id="myModalLabel110"><b>PETUNJUK INPUTAN DATA <?php echo $ModuleName;?>.</b></h5>
                                                </div>
                                                <div class="modal-body">           
                                                <!-- ISO MODAL -->
                                                    <div class="tab-pane fade show active" id="list-monday" role="tabpanel" aria-labelledby="list-monday-list">
                                                    <section class="section">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                    <table class='table table-striped' id='table1' border='1'>
                                    <tr>
                                        <th>Nama Mahasiswa</th><th>Nim</th><th>Kode Prodi</th><th>Tanggal Daftar</th><th>Periode Masuk</th>
                                        <th>Jenis Masuk</th><th>JKelamin</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Agama</th>
                                        <th>NIK</th><th>Negara</th><th>Kelurahan</th><th>ID Wilayah</th><th>Nama Ibu</th><th>Biaya Kuliah</th>
                                    </tr>
                                    <tr>
<td>Nama Mahasiswa</td><td><pre>Nomor Induk <br>Mahasiswa</td><td><pre>Kode ID Prodi <br><a href='?module=feedprodi' target="_blank" ><b>LIHAT DISINI</b></a></td><td><pre>Tanggal Daftar<br> <br>Format yyyy-mm-dd</td>
<td><pre>Periode Masuk <br>contoh : 20191, 
20192, 20201, dst</td>
<td>Jenis Masuk<br><pre>1 : Peserta didik baru
2 : Pindahan 
3 : Naik kelas 
4 : Akselerasi
5 : Mengulang
6 : Lanjutan semester
8 : Pindahan Alih Bentuk
11 : Alih Jenjang
12 : Lintas Jalur
13 : Rekognisi Pembelajaran Lampau (RPL)</td><td><pre>L: Laki-laki <br>P : Perempuan</td><td>Tempat Lahir</td><td><pre>Tanggal Lahir <br>Format yyyy-mm-dd<br>contoh : 1988-12-01</td>
<td><pre>Agama<br>1 : Islam
2 : Kristen
3 : Katholik
4 : Hindu
5 : Budha
6 : Konghucu
99 : Lainnya</td>
<td><pre>Nomor Induk <br>Kependudukan<br><br>Wajib 16 karakter</td><td><pre>Negara<br>ID: Indonesia</td><td>Kelurahan</td><td><pre>ID Wilayah<br>default :000000</td>
<td><pre>Nama Ibu</td><td><pre>Biaya Kuliah, <br>tanpa titi/koma<br>contoh:5000000</td>
                                    </tr>
                                    <tr><td>contoh :</td><td colspan='15'><code><pre>
ABDUL KHANIP	1903018024	193c58aa-1c37-4e04-a7c8-c37e81f2c21f	2019-09-02	20191	1	L	Demak	1985-07-27	1	3321042707850005	ID	Kejawan	000000	Mujanah	5000000
EKA MASKANAH	1903018025	193c58aa-1c37-4e04-a7c8-c37e81f2c21f	2019-09-02	20191	1	P	Pati	1981-12-13	1	3318165312810006	ID	Sekarjalak	000000	Siti Aminah	5000000

</pre></code>
                                    </td></tr>
                                                    </table>
                                                    keterangan :<br> 
                                                                        <code>Copy data di Excel, lalu pastekan di kolom bawah; pemisah antar kolom menggunakan Tab(default ketika copy dari excel); 1 baris = 1 record<br>Untuk Mempercepat Proses, Silahkan Lakukan GETDATA MAHASISWA</code>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="assets/mahasiswa.xlsx"><button type="submit" class="btn btn-primary ml-1" >
                                                                <span class="d-none d-sm-block">Download Excel</span>
                                                                </button></a>
                                                                <a href="#"><button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                                                <span class="d-none d-sm-block">lANJUTKAN</span>
                                                                </button></a>
                                                            </div>
                                                        </div>
                                                    </section>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </ul>
                                                <!-- ISO MODAL -->

                                                    Untuk Cara Penggunaan, Silahkan Klik Petunjuk Penggunaan
                                                  <?php
if ($jmldata > 0){
    if ($aksi !='tambah'){ 
        echo '<div class="alert alert-light-danger color-danger">Masih ada Data Existing Belum di Sync Ke Feeder Sejumlah '.$jmldata.' Record (Belum Sync : '.$belum.', Berhasil : '.$berhasil.', Gagal : '.$gagal.'). 
                    <br>Hapus Terlebih Dahulu Atau Lanjutkan Syncronisasi Untuk Melihat Data<br>
                    <a href="'.$link1.'"><button class="btn btn-primary ml-1" >TAMBAH DATA SEBELUM SYNC </button></a>
                    <a href="'.$link2.'"><button class="btn btn-success ml-1" >LIHAT DATA / LANJUTKAN SYNC</button></a>
                        <!-- MODAL CANCEL -->
                        <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#cancel"> KOSONGKAN </button>   
                        <!--primary theme Modal -->
                        <div class="modal fade text-left" id="cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                    <h5 class="modal-title white" id="myModalLabel110">Konfirmasi Pembatalan</h5>
                                    </div>
                                    <div class="modal-body">
                                    <center>Anda Yakin Ingin Membatalkan  Sejumlah <br>
                                        <h5 class="modal-title black" id="myModalLabel110">' . $jmldata . ' RECORD</center></h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> <span class="d-none d-sm-block"> CLOSE </span></button>
                                        <a href="' . $link3 . '"> <button type="submit" class="btn btn-danger ml-1" > <span class="d-none d-sm-block"> KOSONGKAN </span></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            </div>';
    }else{?>
                                                    <!-- KONDISI KETIKA PENAMBAHAN DATA -->
                                                    <form  method="POST" action="<?php echo $link1; ?>" >
                                                        <div class="form-group with-title mb-3">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="input"></textarea>
                                                            <label>Paste Data Excel di Kolom bawah</label>
                                                        </div>
                                                        <button class="btn btn-outline-secondary" type="submit" >submit</button>
                                                        <br><br>
                                                    </form>          
                                    </div></div>
    <?php
    }
                                        }
                                        else{
                                                  ?>
                                                    <!-- KONDISI KETIKA KOSONG -->
                                                    <form  method="POST" action="<?php echo $link1; ?>" >
                                                        <div class="form-group with-title mb-3">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="input"></textarea>
                                                            <label>Paste Data Excel di Kolom bawah</label>
                                                        </div>
                                                        <button class="btn btn-outline-secondary" type="submit" >Submit</button>
                                                        <br><br>
                                                    </form>          
                                    </div></div>
                                            
<?php
  }//PENUTUP JIKA ADA DATA YANG BELUM DI SYNC
  if (isset($_POST['input']))
  {
      
      $no = 0;
      $input = $_POST['input'];
      $line = explode("\n", $input);
    echo "<div class='table-responsive'>
    <table class='table table-striped' id='table1' border='1'><tr>
    <th>No</th><th>Nim</th><th>Nama Mahasiswa</th><th>Program Studi</th><th>tgl daftar</th><th>semester</th>
    <th>Masuk</th><th>JK</th><th>Tempat Lahir</th><th>tgl Lahir</th><th>Agama</th><th>NIK</th>
    <th>ID Negara</th><th>Kelurahan</th><th>ID Wilayah</th><th>Nama Ibu</th><th>Biaya Kuliah</th>
    </tr>";
    foreach ($line as $baris){
        $baris = explode("\t",$baris);
                
        if (isset($baris[4])){
            $no++;
$nama = $baris[0];
$nim = $baris[1];
$id_prodi = $baris[2];
$tanggal_daftar = $baris[3];
$periode = $baris[4];
$jenis_masuk = $baris[5];
$jenis_kelamin = $baris[6];
$tempat_lahir = $baris[7];
$tanggal_lahir = $baris[8];
$agama = $baris[9];
$nik = $baris[10];
$negara = $baris[11];
$kelurahan = $baris[12];
$idwilayah = $baris[13];
$ibu = $baris[14];
$biaya = $baris[15];

// CEK PROGRAM STUDI
$query = "SELECT * FROM getprodi WHERE id_prodi ='$id_prodi'";
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil)){
$prodi = $x['nama_program_studi'];
$prodi_tampil = "<pre>".$x['nama_program_studi'];
}}else{$prodi=$prodi_tampil ="<code>Prodi tidak ditemukan, Cek UUID PRODI</code>"; }


                $query = "SELECT * FROM getprodi WHERE id_prodi ='$id_prodi'";
                $hasil = mysqli_query($db, $query);
                if(mysqli_num_rows($hasil) > 0 ){
                    while($x = mysqli_fetch_array($hasil)){
                        $prodi = $x['nama_program_studi'];
                }}else{$prodi ="<code>Prodi tidak ditemukan, Cek UUID PRODI</code>"; }

            echo "<tr><td><pre>" . $no;
            echo "</pre></td><td><pre>".$baris[0];
            echo "</pre></td><td><pre>".$baris[1];
            echo "</pre></td><td>".$prodi_tampil;
            echo "</pre></td><td><pre>".$baris[3];
            echo "</pre></td><td><pre>".$baris[4];
            echo "</pre></td><td><pre>".$baris[5];
            echo "</pre></td><td><pre>".$baris[6];
            echo "</pre></td><td><pre>".$baris[7];
            echo "</pre></td><td><pre>".$baris[8];
            echo "</pre></td><td><pre>".$baris[9];
            echo "</pre></td><td><pre>".$baris[10];
            echo "</pre></td><td><pre>".$baris[11];
            echo "</pre></td><td><pre>".$baris[12];
            echo "</pre></td><td><pre>".$baris[13];
            echo "</pre></td><td><pre>".$baris[14];
            echo "</pre></td><td><pre>".$baris[15];
            echo "</pre></td></tr>";
            

$insert = "INSERT INTO insertmahasiswa 
(nama_mahasiswa, nim, prodi_uuid, tanggal_daftar, periode, 
Jenis_masuk, jk, Tempat_Lahir, Tanggal_Lahir, Agama, NIK, 
negara, Kelurahan, ID_wilayah, ibu, Biaya_Masuk, nama_prodi, insertid) 
VALUES 
('$nama', '$nim', '$id_prodi', '$tanggal_daftar', '$periode', 
'$jenis_masuk', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$agama', '$nik', 
'$negara', '$kelurahan', '$idwilayah', '$ibu', '$biaya', '$prodi', '$insertid');";
// // echo $insert;
mysqli_query($db, $insert);
        }
    }
    echo "<table></div>";
    echo '
<ul class="pagination pagination-primary  justify-content-center">               
    <!-- MODAL CANCEL -->
    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#cancel">  CANCEL </button>   
        <!--primary theme Modal -->
        <div class="modal fade text-left" id="cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel110">Konfirmasi Pembatalan</h5>
                    </div>
                    <div class="modal-body">
                    <center>Anda Yakin Ingin Membatalkan  Sejumlah <br>
                        <h5 class="modal-title black" id="myModalLabel110">' . $no . ' RECORD</center></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> <span class="d-none d-sm-block"> Close </span> </button>
                        <a href="'.$cancel.'"> <button type="submit" class="btn btn-danger ml-1" > <span class="d-none d-sm-block">  BATALKAN  </span></button></a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- MODAL PROSES -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#proses"> PROSES </button>
        <!--primary theme Modal -->
        <div class="modal fade text-left" id="proses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel110">  KONFIRMASI  </h5>
                    </div>
                    <div class="modal-body">
                    <center>Anda Yakin Ingin Memproses Mahasiswa Keluar Sejumlah <br>
                        <h5 class="modal-title black" id="myModalLabel110">' . $no . ' RECORD</center></h5>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> <span class="d-none d-sm-block">  CLOSE  </span></button>
                    <a href="' . $link4 . '"><button type="submit" class="btn btn-success ml-1" > <span class="d-none d-sm-block">  lANJUTKAN  </span></button></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
</ul>                                   
';
    //  print_r ($line);
    // echo $input;
    
    echo '<script>
        $(document).ready(function() {
            
                $("html, body").animate({
                    scrollTop: $(
                      '. "'html, body'".').get(0).scrollHeight
                }, 2000);
            
        });
    </script>';
}
else
{
}



?>
    </div>
                                        </div>

                                    </section>

                                   
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>  

<!-- SIDEBAR -->


</div>
</section>

</div>
