<?php 
// $module="Akmimport";
$ModuleName = "MATA KULIAH";
$table = "insertmatakuliah";
$link1 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=tambah'; //tambah data
$link2 = "index.php?module=inject&act=".$module; //Lihat Data / Lanjutkan Sync
$link3 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=kosongkan'; // Kosongkan Data 
$link4 = $_SERVER['PHP_SELF'] . '?module=inject&act='.$module.'&show=no' ; // PAGE SYNCRON KE FEEDER
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
                                    <tr><th>Kode_Makul</th><th>Nama_Makul</th><th>id_prodi</th><th width='65'>id_jenis_makul</th><th>SKS</th></tr>
                                    <tr><td>Kode Mata kuliah</td><td>Nama Mata Kuliah</td><td>kode uuid Prodi<br><a href='?module=feedprodi' target="_blank" ><b>LIHAT DISINI</b></a></td>
                                    <td>A=Wajib, B=Pilihan, C=Wajib Peminatan, D=Pilihan Peminatan, S=Tugas akhir/Skripsi/Tesis/Disertasi</td>
                                    <td>Jumlah SKS, SKS 0 Tidak bisa dinputkan</td></tr>
                                    <tr><td>contoh :</td><td colspan='4'><code><pre>
IAT-803008	Tafsir Tematik	35a171c9-f5c8-465c-a735-4eac26e982e7	A	3
IAT-2205	Metodelogi Penelitian	35a171c9-f5c8-465c-a735-4eac26e982e7	A	3
</pre></code>
                                    </td></tr>
                                                    </table>
                                                    keterangan :<br> 
                                                                        <code>Copy data di Excel, lalu pastekan di kolom bawah; pemisah antar kolom menggunakan Tab(default ketika copy dari excel); 1 baris = 1 record<br>Untuk Mempercepat Proses, Silahkan Lakukan GETDATA MAHASISWA</code>

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
      
      $no = 0;
      $input = $_POST['input'];
      $line = explode("\n", $input);
    echo "<table class='table table-striped' id='table1' border='1'><tr>
    <th>No</th><th>kode MK</th><th>Nama Mata Kuliah</th><th>Program Studi</th><th>Jenis MK</th><th>SKS</th></tr>";
    foreach ($line as $baris){
        $baris = explode("\t",$baris);
                
        if (isset($baris[2])){
            $no++;
                $id_prodi = $baris[2];
                $query = "SELECT * FROM getprodi WHERE id_prodi ='$id_prodi'";
                $hasil = mysqli_query($db, $query);
                if(mysqli_num_rows($hasil) > 0 ){
                    while($x = mysqli_fetch_array($hasil)){
                        $prodi = $x['nama_program_studi'];
                }}else{$prodi ="<code>Prodi tidak ditemukan, Cek UUID PRODI</code>"; }

            echo "<tr><td>" . $no;
            echo "</td><td>".$baris[0];
            echo "</td><td>".$baris[1];
            echo "</td><td>".$prodi;
            echo "</td><td>".$baris[3];
            echo "</td><td>".$baris[4]."</td></tr>";
            

            $insert = "INSERT INTO insertmatakuliah (kode_mata_kuliah, nama_mata_kuliah, id_prodi, 
            nama_program_studi, id_jenis_mata_kuliah, sks_mata_kuliah,sks_tatap_muka,insertid) VALUES 
            ('$baris[0]', '$baris[1]', '$id_prodi', '$prodi', '$baris[3]', '$baris[4]','$baris[4]', '$insertid');";
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
