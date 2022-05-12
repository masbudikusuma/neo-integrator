<?php
$table = "getdosen";
$methodfeed = "GetDosen";
$countneofeedermethod = "GetCountDosen";
$exec = "getDosen";

$jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
$jumlah = mysqli_query($db, $jumlah);
$x = mysqli_fetch_array($jumlah);
$total = $x['jumlah'];

$neofeeder = $ws->prep_get($countneofeedermethod);
        $neofeeder = $ws->run($neofeeder);
        $neofeeder = $neofeeder[1]["data"];
        

$sync = $weburl.'app/exec.php?act='.$exec;
?>
<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="content-wrapper container">

<div class="page-content">
    <section class="row">
    <div class="col-12 col-lg-12">
                    <div class="page-heading">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h3><?php echo $ModuleName; ?></h3>
                            </div>
                            <div class="card-body">
                            <div class="buttons">
                            <!-- data -->
                            <button type="button" class="btn btn-primary" >
                                Data NEO HELPER <span class="badge bg-transparent" id="datamkhelper"><?php echo $total; ?></span>
                            </button>
                            <button type="button" class="btn btn-success">
                            Data NEO FEEDER <span class="badge bg-transparent"><?php echo $neofeeder;?></span>
                            </button>
                            <a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-danger">
                            IMPORT dari NEO FEEDER
                            </button></a>
                            <br>
                            *sumber data di neo-integrator<br>
                            abaikan jika ada selisih, karena Data diambil dari <code>DetailBiodataDosen</code> dan jumlah data dari method <code><?php echo $countneofeedermethod;?></code>
                        </div>


                                <!-- <?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>  -->
                                <table class="table table-striped" id="table1" border="1">
                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                            <th>Nama Dosen</th>
                                            <th>NIDN</th>
                                            <th>NIP</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Status</th>
                                            <th>Jenis Dosen</th>
                                            <th>ID Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$no = 0;
$query = "SELECT * FROM ".$table;
// echo $query;
$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){

    while($x = mysqli_fetch_array($hasil)){
        $no++;
        $nama_dosen = $x['nama_dosen'];
        $nidn = $x['nidn'];
        $nip = $x['nip'];
        $tanggal_lahir = $x['tanggal_lahir'];
        $nama_status_aktif = $x['nama_status_aktif'];
        $nama_jenis_sdm = $x['nama_jenis_sdm'];
        $id_dosen = $x['id_dosen'];
        
        echo '<tr><td><b><pre>'.$no.'</b></td><td><pre>'.$nama_dosen.'</td>
<td><pre>'.$nidn.'</td><td><pre>'.$nip.'</td>
<td><pre>'.$tanggal_lahir.'</td><td><pre>'.$nama_status_aktif.'</td><td><pre>'.$nama_jenis_sdm.'</td><td><pre>'.$id_dosen.'</pre></td</tr>';
// echo "====================="        ;
}}else{$prodi ="<code>Prodi tidak ditemukan, Cek UUID PRODI</code>"; }

            ?>
  
                                      
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </section>
                </div>
    </div>  

    <!-- SIDEBAR -->
    
    
</div>
</section>

</div>

<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>