<?php 
$module="cekAKM";
$ModuleName = "CEK Aktivitas Kuliah Mahasiswa";
$table = "cekmahasiswa";
$link1 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=tambah'; //tambah data
$link2 = "index.php?module=inject&act=".$module; //Lihat Data / Lanjutkan Sync
$link3 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=cancel'; // Kosongkan Data / Cancel
$link4 = $_SERVER['PHP_SELF'] . '?module=inject&act='.$module.'&show=no' ; // PAGE SYNCRON KE FEEDER
// $link4 = $_SERVER['PHP_SELF'] . '?module='.$module.'&aksi=tambah'; //Submit Inputan
// ACT DETECT
if (isset($_GET['aksi']))
{
        $aksi = $_GET['aksi'];
    switch ($_GET['aksi'])
    {
        case "cancel":
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
                                    <h4 class="card-title"> <?php echo $ModuleName;?></h4>
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
                                                                        <tr><th colspan='2'>NIM</th></tr>
                                                                        <tr><td colspan='2'>Nomor Induk Mahasiswa</td></tr>
                                                                        <tr><td>contoh :</td><td ><code><pre>
1903017025	NAMA1
1903017009	NAMA2
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
                                                Untuk Cara Penggunaan, Silahkan Klik Petunjuk Penggunaan<br>
                                                
                                                  <?php
$jmldata = 0;
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
                                                    <button disabled>Data AKM : <?php jmlakm($jmlakm); echo $jmlakm; ?> Record</button>
                                                    <form  method="POST" action="<?php echo $link1; ?>" >
                                                        <div class="form-group with-title mb-3">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="input"></textarea>
                                                            <label>Paste Data Excel di Kolom bawah</label>
                                                        </div>
                                                        *Jika Jumlah Data AKM 0, silahkan <a href="index.php?module=tarikdata"><b>TARIKDATA GetAKM</b> </a> dahulu<br>
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
    <th>Baris</th><th>NIM</th><th>NAMA</th><th>Program Studi</th><th>Jumlah Akm</th><th>Detail AKM</th></tr>";
    foreach ($line as $baris)
    {
        $baris = explode("\t", $baris);
        // print_r($baris);
        if (isset($baris[0]))
        {
            $no++;
            $nim = $baris[0];
            // $id_reg_mhs = $nama = $jk=$tl =$prodi = $status=$baris[0];

$query = "SELECT nim, a.nama_mahasiswa, a.nama_program_studi, a.id_semester AS jumlah, a.nama_status_mahasiswa as status  FROM getakm AS a WHERE a.nim  = '".$nim."' ORDER BY a.id_semester asc";
// echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
    // $no++;
    $jmlakm = 0;
    $detail = "";
    while($x = mysqli_fetch_array($hasil)){
        $jmlakm++;
        $nim = $x['nim'];
        $nama = $x['nama_mahasiswa'];
        $prodi = $x['nama_program_studi'];
        $semester = $x['jumlah'];
        $status = $x['status'];
        $detail = $detail . $semester."(".$status.");";
        
}
echo '<tr style=font-size:12px><td><b>'.$no.'</b></td><td>'.$nim.'</td><td>'.$nama.'</td><td>'.$prodi.'</td>
<td>'.$jmlakm.'</td><td style=font-size:12px>'.$detail.'</td></tr>';

}else{
    echo '<tr style=font-size:11px><td><b>'.$no.'</b></td><td>'.$nim.'</td><td><code>Tidak Ditemukan</code></td><td><code>Tidak Ditemukan</code></td><td><code>Tidak Ditemukan</code></td><td><code>Tidak Ditemukan</code></td></tr>';
}



            // echo $nim;
            // caribiomhs($nim,$nama,$jk,$tl,$prodi,$status);
            // // $id_reg_mahasiswa = $id_reg_mhs;
            // echo "<tr><td>" . $no;
            // echo "</td><td>" . $nim;
            // echo "</td><td>" . $nama;
            // echo "</td><td>" . $jk;
            // echo "</td><td>" . $tl;
            // echo "</td><td>" . $status;
            // echo "</td><td>" . $prodi . "</td></tr>";
        }
    }
    echo "<table>";
    // echo '<a><button class="btn btn-outline-secondary" type="warning" >Sumbit</button></a>'."\t";
   
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
