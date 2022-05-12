<!-- <meta http-equiv="refresh" content="120" > -->
<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="content-wrapper container">

<div class="page-content">
    <section class="row">
    <div class="col-12 col-lg-12">
                    <div class="page-heading">


<div class="content-wrapper container">
<div class="page-content">
    <section class="row">
<div class="page-heading">
    <section class="section">
        <div class="card">
        <div class="card-header">
                                <h3><?php echo $ModuleName;
                                $max_time = ini_get('max_execution_time');
                                ?>
                                </h3>
                                
keterangan : <br>

<?php if (isset($_GET['semester'])){$semester  = $_GET['semester'];} else {$semester="20211";} ?>
ChekPoint Versi Neo-Integrator Semester <b><?php echo $semester;?></b>
Sumber Data : Neo Feeder

<pre>
Pilih Semester :
<div class="btn-group mb-3" role="group" aria-label="Basic example">
<a href="index.php?module=checkpoint&semester=20181"><button type="button" class="btn btn-secondary">20181</button></a>
<a href="index.php?module=checkpoint&semester=20182"><button type="button" class="btn btn-secondary">20182</button></a>
<a href="index.php?module=checkpoint&semester=20191"><button type="button" class="btn btn-secondary">20191</button></a>
<a href="index.php?module=checkpoint&semester=20192"><button type="button" class="btn btn-secondary">20192</button></a>
<a href="index.php?module=checkpoint&semester=20201"><button type="button" class="btn btn-secondary">20201</button></a>
<a href="index.php?module=checkpoint&semester=20202"><button type="button" class="btn btn-secondary">20202</button></a>
<a href="index.php?module=checkpoint&semester=20211"><button type="button" class="btn btn-secondary">20211</button></a>
<a href="index.php?module=checkpoint&semester=20212"><button type="button" class="btn btn-secondary">20212</button></a></div> 
</pre>
                            <!-- </div> -->

            <div class="card-body">
                <table class="table table-light mb-0" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Prodi</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang</th>
                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="GetCountPerkuliahanMahasiswa">Jumlah AKM</th>
                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="GetCountAktivitasMengajarDosen">Jumlah Dosen</th>
                        </tr>
                    </thead>
                    <!-- <tbody id="logprogress"> -->
                    <tbody>
                        <?php
                    $query = "SELECT * from getprodi ";

$hasil = mysqli_query($db, $query);
if(mysqli_num_rows($hasil) > 0 ){
while($x = mysqli_fetch_array($hasil))
{
    jmlakmdetail($jmlakm,$x['id_prodi'],$semester); 
    jmldosenprodi($jmldosen,$x['id_prodi'],$semester); 
    echo "<tr>
<td >".$x['kode_program_studi']."</td>
<td >".$x['nama_program_studi']."</td>
<td >".$x['nama_jenjang_pendidikan']."</td>
<td data-bs-toggle='tooltip' data-bs-placement='top' title='GetCountPerkuliahanMahasiswa'>".$jmlakm."</td>
<td data-bs-toggle='tooltip' data-bs-placement='top' title='GetCountAktivitasMengajarDosen'>".$jmldosen."</td>

</tr>";
}
}
?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

</section>
</div>
</div>