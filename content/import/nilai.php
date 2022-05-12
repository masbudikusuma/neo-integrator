<?php 
// $module="Akmimport";
$ModuleName = "Nilai Kelas Kuliah";
$table = "insertnilaikuliahkelas";
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
<tr><th>nim</th><th>Kode_MK</th><th>Kode_Kelas</th><th>Semester</th><th>nilai_angka</th><th>nilai_indeks</th><th>nilai_huruf</th></tr>
                                    <tr><td><dd class="text-sm word-wrap">Nomor Induk Mahasiswa</dd>                                    </td>
                                    <td><dd class="text-sm word-wrap">Kode Mata Kuliah</dd><br><a href='?module=feedmk' target="_blank" >Kode MK</a></td>
                                    <td><pre>Kode Kelas Kuliah<br>max 5 Digit<br><br><a href='?module=feedkelaskuliah' target="_blank" >Kode Kelas</a></td>
                                    <td>Semester<br> contoh= 20201,20202,dst</td>
                                    <td>Nilai Angka <br> Skala 10</td>
                                    <td>Nilai Index <br> Skala 4</td>
                                    <td>Nilai Huruf <br> A,B,C,D,E</tr>
                                    <tr><td>contoh :</td><td colspan='7'><code><pre>
2101028001	KPI-803003	20211	2KPI1	70	3.7	B+
2101028001	KPI-803004	20211	2KPI1	75	3.8	B+
</pre></code>
                                    </td></tr>
                                                    </table>
                                                    keterangan :<br> 
                                                    <code>Copy data di Excel, lalu pastekan di kolom bawah; pemisah antar kolom menggunakan Tab(default ketika copy dari excel); 1 baris = 1 record
                                                <br>Untuk Mempercepat Proses, Silahkan Lakukan GET DATA PRODI dan DATA Mata Kuliah</code>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
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
    //   8 Column
      $no = 0;
      $input = $_POST['input'];
      $line = explode("\n", $input);
    echo "<table class='table table-striped' id='table1' border='1'>
    <tr><th><pre>NO</th><th><pre>Nim</th><th><pre>Nama</th><th>Program studi</th><th><pre>Kode MK</th><th><pre>Semester</th>
    <th><pre>N. Indeks</th><th><pre>N. Huruf</th><th><pre>N. Angka</th>
    <th><pre>Kode Kelas</th></tr>";
    foreach ($line as $baris){
        $baris = explode("\t",$baris);
                
        if (isset($baris[2])){
            $no++;
                $nim = $baris[0];
                $kodemk = $baris[1];
                $semester = $baris[2];
                $namakelas = $baris[3];
                $nilaiangka = $baris[4];
                $nilaiindex = $baris[5];
                $nilaihuruf = $baris[6];

                // Get ID REG MAHASISWA
                $query = "SELECT * from getmahasiswa where nim='$nim'";
                $hasil = mysqli_query($db, $query);
                if(mysqli_num_rows($hasil) > 0 ){
                while($x = mysqli_fetch_array($hasil)){
                $namaprodi = $x['nama_program_studi'];
                $id_prodi = $x['id_prodi'];
                $nama_mahasiswa = $x['nama_mahasiswa'];
                $id_registrasi_mahasiswa = $x['id_registrasi_mahasiswa'];                
                }}else{
                $namaprodi = "<code>tidak ditemukan</code>";
                $id_prodi = "<code>tidak ditemukan<code>";
                $nama_mahasiswa = "<code>NIM ditemukan<code>";
                $id_registrasi_mahasiswa = "<code>tidak ditemukan<code>";
                }

                $id_key= $semester."_".$namakelas."_".$kodemk."_".$id_prodi;
                
                // Get Kelas Kuliah
                $query = "SELECT * from getkelaskuliah where id_key='$id_key'";
                $hasil = mysqli_query($db, $query);
                if(mysqli_num_rows($hasil) > 0 ){
                while($x = mysqli_fetch_array($hasil)){
                $id_kelas_kuliah = $x['id_kelas_kuliah'];
                $nama_mata_kuliah = $x['nama_mata_kuliah'];
                $nama_kelas_kuliah = $x['nama_kelas_kuliah'];
                $tampilkelas = "<pre>".$x['id_kelas_kuliah'];

                }}else{
                $nama_kelas_kuliah =  $id_kelas_kuliah = $nama_mata_kuliah = "tidak ditemukan";
                $tampilkelas = "<code><pre>".$nama_kelas_kuliah;
                }

                        // WAJIB
                        // if($idwajib==1){$wajib="<pre>"."Wajib";} else if($idwajib==0){$wajib="<pre>"."Tidak Wajib";} else {$wajib="<code><pre>Err : hanya 0 / 1</pre></code>";$idwajib='0';}

            echo "<tr><td>" . $no;
            echo "</td><td><pre>".$baris[0];
            echo "</td><td><pre>".$nama_mahasiswa;
            echo "</td><td><pre>".$namaprodi;
            
            echo "</td><td><pre>".$kodemk;
            echo "</td><td><pre>".$baris[2];
            echo "</td><td><pre>".$nilaiindex;
            echo "</td><td><pre>".$nilaihuruf;
            echo "</td><td><pre>".$nilaiangka;
            echo "</td><td>".$tampilkelas."</td></tr>";
            

            $insert = "INSERT INTO insertnilaikuliahkelas 
            (id_registrasi_mahasiswa, id_periode,  nama_mata_kuliah, 
            kode_mata_kuliah, id_kelas, nama_kelas_kuliah, 
            nilai_angka, nilai_indeks, nilai_huruf, nim, 
            nama_mahasiswa, insertid) VALUES 
            ('$id_registrasi_mahasiswa', '$semester',  '$nama_mata_kuliah', 
            '$kodemk', '$id_kelas_kuliah', '$nama_kelas_kuliah',  
            '$nilaiangka', '$nilaiindex', '$nilaihuruf', '$nim', 
            '$nama_mahasiswa', '$insertid');";
            // echo $insert;
            mysqli_query($db, $insert);
        }
    }
    echo "<table>";
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
