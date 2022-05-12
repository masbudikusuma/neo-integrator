<?php 


// $module="Akmimport";
$ModuleName = "MAHASISWA KELUAR / LULUS / DO";
$table = "insertmahasiswalulusdo";
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
                                                                        <tr><th>NIM</th><th>ID Keluar</th><th>tanggal_keluar</th>
                                                                        <th>id_periode_keluar</th><th>ipk</th><th>nomor_ijazah</th></tr>

                                                                        <tr><td>Nomor Induk Mahasiswa</td><td>
                                                                        1 : Lulus; 2 : Mutasi; 3 : Dikeluarkan; <br>4 : Mengundurkan diri; 5 : Putus Sekolah; 6 : Wafat; 7 : Hilang; 8 : Alih Fungsi; 9 : Pensiun; 0 : Lainnya</td>
                                                                        <td>Format<br>YYYY-MM-DD</td>
                                                                        <td>ID Semester contoh 20212</td><td>IPK</td>
                                                                        <td>No Ijazah</td></tr>
                                                                        <tr><td>contoh :</td><td colspan='5'><code><pre>
1903017025	1	2019-05-15	20191	3	No12345
1903017009	1	2019-05-15	20191	3.5	No12345</pre></code>
                                                                        </td></tr>
                                                                        </table>
                                                                        keterangan :<br> 
                                                                        <code>Copy data di Excel, lalu pastekan di kolom bawah; pemisah antar kolom menggunakan Tab; 1 baris = 1 record<br>Untuk Mempercepat Proses, Silahkan Lakukan GETDATA MAHASISWA</code>

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
                                                        <button class="btn btn-outline-secondary" type="submit" >Sumbit</button>
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
                                                        <button class="btn btn-outline-secondary" type="submit" >Sumbit</button>
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
    echo "<table class='table table-striped' id='table1' border='1'><tr>
    <th>Baris</th><th>NIM</th><th>NAMA</th><th>ID_Reg_mhs</th><th>ID Keluar</th><th>tanggal_keluar</th>
    <th>SMT Keluar</th><th>IPK</th><th>nomor_ijazah</th></tr>";
    foreach ($line as $baris)
    {
        $baris = explode("\t", $baris);
        // print_r($baris);
        if (isset($baris[2]))
        {
            $no++;
            str_replace('"','',$baris);
            $nim = $prodi= $id_reg_mhs = $nama = $baris[0];
            $tanggalkeluar = date("Y-m-d", strtotime($baris[2]));
            cariidregmhs($nim, $id_reg_mhs, $nama,$prodi);
            $nama_mahasiswa = $nama;
            $id_jenis_keluar = $baris[1];
            $id_periode_keluar = $baris[3];
            if (isset($baris[4])){$ipk = $baris[4];}else{$ipk = '';}
            if (isset($baris[5])){$nomor_ijazah = $baris[5];}else{$nomor_ijazah = '';}
            // $ipk = $baris[4];
            // $nomor_ijazah = $baris[5];
            $id_reg_mahasiswa = $id_reg_mhs;
            echo "<tr><td>" . $no;
            echo "</td><td>" . $nim;
            echo "</td><td>" . $nama;
            echo "</td><td>" . $id_reg_mhs;
            echo "</td><td>" . $id_jenis_keluar;
            echo "</td><td>" . $tanggalkeluar;
            echo "</td><td>" . $id_periode_keluar;
            echo "</td><td>" . $ipk;
            echo "</td><td>" . $nomor_ijazah . "</td></tr>";
            $insert = "INSERT INTO insertmahasiswalulusdo (
                id_reg_mahasiswa, nim, nama_mahasiswa, 
                id_jenis_keluar, id_periode_keluar, 
                tanggal_keluar, nomor_ijazah, ipk,insertid) VALUES 
                (
                '$id_reg_mahasiswa', '$nim', '$nama_mahasiswa', 
                '$id_jenis_keluar', '$id_periode_keluar', '$tanggalkeluar', 
                 '$nomor_ijazah', '$ipk','$insertid')";
            mysqli_query($db, $insert);

        }
    }
    echo "<table>";
    // echo '<a><button class="btn btn-outline-secondary" type="warning" >Sumbit</button></a>'."\t";
    echo '
<ul class="pagination pagination-primary  justify-content-center">               
    <!-- MODAL CANCEL -->
    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#cancel">
    CANCEL
    </button>   
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
