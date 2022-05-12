<?php
$table = "getkurikulum";
$methodfeed = "GetDetailKurikulum";
$exec = "getKurikulum";

$jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
$jumlah = mysqli_query($db, $jumlah);
$x = mysqli_fetch_array($jumlah);
$total = $x['jumlah'];

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
                            <a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-danger">
                            IMPORT dari NEO FEEDER
                            </button></a>
                            <br>
                            *sumber data di neo-integrator
                        </div>

                                <!-- <?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>  -->
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                            <th>Nama Kurikulum</th>
                                            <th>Nama Program Studi</th>
                                            <th>ID PRODI</th>
                                            <th>Mulai Berlaku</th>
                                            <th>SKS Lulus</th>
                                            <th>SKS Wajib</th>
                                            <th>SKS Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php

$request = $ws->prep_get($methodfeed,"","","");
        $ws_result = $ws->run($request);
$no =0;
if ($ws_result[1]["error_code"] == 0) {

foreach ($ws_result as $key){
if (is_array($key)){
foreach ($key as $key2){
	if (is_array($key2)){
			foreach ($key2 as $key3){
                $no++;
	$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
    $id_prodi = $key3['id_prodi'];
     $nama_kurikulum = $key3['nama_kurikulum'];
    $semester_mulai_berlaku = $key3['semester_mulai_berlaku']; 
    $jumlah_sks_lulus = $key3['jumlah_sks_lulus'];
    $jumlah_sks_wajib = $key3['jumlah_sks_wajib'];
    $jumlah_sks_pilihan = $key3['jumlah_sks_pilihan'];
    echo '<tr><td><b>'.$no.'</b></td><td><pre>'.$nama_kurikulum.'</td>
    <td><pre>'.$nama_program_studi.'</td><td><pre>'.$id_prodi.'</td><td><pre>'.$semester_mulai_berlaku.'</td>
    <td><pre>'.$jumlah_sks_lulus.'</td><td><pre>'.$jumlah_sks_wajib.'</td><td><pre>'.$jumlah_sks_pilihan.'</td></tr>';
            }}}}}}
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