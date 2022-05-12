<?php
$table = "getprodi";
$methodfeed = "GetProdi";
$exec = "getProdi";
$countneofeedermethod = "GetCountProdi";


$jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
$jumlah = mysqli_query($db, $jumlah);
$x = mysqli_fetch_array($jumlah);
$total = $x['jumlah'];

$neofeeder = $ws->prep_get($countneofeedermethod);
        $neofeeder = $ws->run($neofeeder);
        $neofeeder = $neofeeder[1]["data"];
$sync = $weburl.'/exec.php?act='.$exec;
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
                            *sumber data di neo-integrator
                        </div>


                                <!-- <?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>  -->
                                <table class="table table-striped" id="table1" border="1">
                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                            <th>Program Studi</th>
                                            <th>Kode Prodi</th>
                                            <th>ID / UUID Prodi</th>
                                            <th>status</th>
                                            <th>Jenjang</th>
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
        $nama_program_studi = $x['nama_program_studi'];
        $kode_program_studi = $x['kode_program_studi'];
        $id_prodi = $x['id_prodi'];
        $status = $x['status'];
        $nama_jenjang_pendidikan = $x['nama_jenjang_pendidikan'];
        
        echo '<tr><td><b><pre>'.$no.'</b></td><td><pre>'.$nama_program_studi.'</td>
<td><pre>'.$kode_program_studi.'</td><td><pre>'.$id_prodi.'</td>
<td><pre>'.$status.'</pre></td><td><pre>'.$nama_jenjang_pendidikan.'</pre></td></tr>';
// echo "====================="        ;
}}else{$prodi ="<code>Prodi tidak ditemukan, Cek UUID PRODI</code>"; }



// $request = $ws->prep_get($methodfeed,"","","");
//         $ws_result = $ws->run($request);
// $no =0;
// if ($ws_result[1]["error_code"] == 0) {

// foreach ($ws_result as $key){
// if (is_array($key)){
// foreach ($key as $key2){
// 	if (is_array($key2)){
// 			foreach ($key2 as $key3){
//                 $no++;
// 	$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
// 	$kode_program_studi = $key3['kode_program_studi'];
//     $id_prodi = $key3['id_prodi'];
//     $status = $key3['status'];
//     $nama_jenjang_pendidikan = $key3['nama_jenjang_pendidikan']; 
//     echo '<tr><td><b>'.$no.'</b></td><td>'.$nama_program_studi.'</td>
//     <td>'.$kode_program_studi.'</td><td>'.$id_prodi.'</td>
//     <td>'.$status.'</td><td>'.$nama_jenjang_pendidikan.'</td></tr>';
//             }}}}}}
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