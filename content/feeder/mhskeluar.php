<div class="content-wrapper container">

<div class="page-content">
    <section class="row">
    <div class="col-12 col-lg-12">
                    <div class="page-heading">
                    
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                Data Mahasiswa Keluar
                            </div>
                            
                        

                            <div class="card-body">
                                <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>" >
                                        <div class="col-md-4 mb-1">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="bi bi-search"></i></span>
                                                    <input type="text" class="form-control" placeholder="NIM" name="filter" >
                                                    <button class="btn btn-outline-secondary" type="submit" >Search</button>
                                                </div>
                                            </div>
                                </form>          
                                <!-- <?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>  -->
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>ProgramStudi</th>
                                            <th>Angkatan</th>
                                            <th>Jenis Keluar</th>
                                            <th>tanggal Keluar</th>
                                            <th>Periode Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
if (isset($_GET['page'])){$page  = $_GET['page'];} else {$page=1;}
if (isset($_POST['filter'])){$filter  = $_POST['filter']; 
    $filter="nim='".$filter."' or nama_mahasiswa='".$filter."'";} else {$filter="";}
// $filter = "";
$limit = 10;
$order = $page - 1;
$request = $ws->prep_get('GetDetailMahasiswaLulusDO',$filter,$limit,$order);
			$ws_result = $ws->run($request);
			// $ws->view($ws_result);

			$kosongkantabel = "TRUNCATE getmahasiswalulusdo;";
			mysqli_query($db ,$kosongkantabel);
$no =0;
$rec = 0;

if ($ws_result[1]["error_code"] == 0) {

foreach ($ws_result as $key){
if (is_array($key)){
foreach ($key as $key2){
	if (is_array($key2)){
			foreach ($key2 as $key3){
                $no++;
                $rec = ($order * 10) + $no;
	$nama_program_studi	= hapus_tanda($key3['nama_program_studi']);
	$nim = $key3['nim'];
	$nama_mahasiswa	= hapus_tanda($key3['nama_mahasiswa']);
	$angkatan = $key3['angkatan'];
	$nama_jenis_keluar = $key3['nama_jenis_keluar'];
	$tanggal_keluar = date("Y-m-d", strtotime('tanggal_keluar'));  
	$nomor_ijazah = $key3['nomor_ijazah'];
	$id_periode_keluar = $key3['id_periode_keluar'];	
    echo '<tr><td>'.$rec.'</td><td>'.$nim.'</td><td>'.$nama_mahasiswa.'</td>
    <td>'.$nama_program_studi.'</td><td>'.$angkatan.'</td>
    <td>'.$nama_jenis_keluar.'</td><td>'.$tanggal_keluar.'</td>
    <td>'.$id_periode_keluar.'</td></tr>';
            }}}}}}
            ?>
  
                                      
                                    </tbody>
                                </table>

                                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-primary  justify-content-center">
                        <li class="page-item <?php if ($order < 1){echo 'disabled';}?>">
                            <a class="page-link" href="index.php?module=mhskeluarfeed&page=<?php echo $page - 1; ?>"   >Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" ><?php echo $page; ?></a></li>
                        <li class="page-item"><a class="page-link"  disabled><?php jmllulus($jmllulus);echo " Total $jmllulus";?></a></li>
                        <li class="page-item">
                            <a class="page-link" href="index.php?module=mhskeluarfeed&page=<?php echo $page + 1; ?>">Next</a>
                        </li>
                    </ul>
                    <ul class="pagination pagination-primary  justify-content-center">
                        
                    </ul>
                </nav>
                            </div>
                        </div>
                    </section>
                </div>
    </div>  

    <!-- SIDEBAR -->
    
    
</div>
</section>

</div>

<!-- <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script> -->