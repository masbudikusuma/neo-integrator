<?php
include "../config.php";
 ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mata Kuliah
        <small>Cek data Matakuliah di AKademik dan Feeder</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Wabot</a></li>
        <li class="active">Library</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <b> keterangan : </b>Module untuk mengecek status MK di Akademik dan Feeder <br>
              1. Tarik data MK dari akademik ke server Local (Module Manual)<br>
              2. Tarik Data MK dari feeder ke server Local

<table border='3'>
  <thead>
  <tr>
    <th>no</th>
    <th>Kode MK</th>
    <th>Nama MK</th>
    <th>Prodi</th>
    <th>status</th>
  </tr>
  </thead>
  <tbody border='2'>
                <?php
                // sys_log("Show mahasiswa akademik");

                // Mencari MK Fakultas bukan MK Prodi dan belum masuk ke pddikti
//                 $sql_mk = "SELECT	a.kode_mk, a.nama_mk, a.sks, a.kode_prodi AS kd_prodi,b.kode AS kode_prodi,
// b.nama as nama_prodi, b.uuid_uin , c.id_matkul
// FROM akd_kurikulum as a
// LEFT JOIN akd_prodi as b on b.kode_fak=a.kode_prodi
// left JOIN feeder_sync_mk AS c ON a.kode_mk = c.kode_mk
// WHERE LENGTH(a.kode_prodi) = 2 AND c.id_matkul IS NULL
// ORDER BY a.kode_mk";

// Mencari MK Fakultas  Prodi dan belum masuk ke pddikti
$sql_mk = "SELECT	a.kode_mk, a.nama_mk, a.sks, a.kode_prodi AS kd_prodi,b.kode AS kode_prodi,
b.nama as nama_prodi, b.uuid_uin , c.id_matkul
FROM akd_kurikulum as a
LEFT JOIN akd_prodi as b on b.kode=a.kode_prodi
left JOIN feeder_sync_mk AS c ON a.kode_mk = c.kode_mk
WHERE LENGTH(a.kode_prodi) = 4 AND c.id_matkul IS NULL
ORDER BY a.kode_mk";


                      // $sql = "SELECT a.kode_mk AS kdmk_akd, b.kode_mk AS kdmk_feeder,
                      // a.nama_mk AS nm_akd, b.nama_mk AS nm_feeder,
                      // a.sks AS sks_akd, b.sks AS sks_feeder,
                      // b.id_matkul  as id_matkul
                      // FROM akd_mk as a
                      // LEFT JOIN feeder_sync_mk AS b ON a.kode_mk = b.kode_mk
                      // ORDER BY a.kode_mk ASC";

                      $result = mysqli_query($db ,$sql_mk) or die(mysqli_error($db));
                      $no=0;

                      if ($result->num_rows > 0) {
                           // output data of each row
                           while($row = $result->fetch_assoc()) {
                             $no++;
                               // INSERT KE FEEDER
                               $data = array(
                             		'kode_mata_kuliah' 	=> $row["kode_mk"],
                             		'nama_mata_kuliah' 	=> $row["nama_mk"],
                             		'id_prodi'		=> $row["uuid_uin"],
                             		'sks_mata_kuliah' => $row["sks"],
                             		'id_jenis_mata_kuliah' => 'A'
                             	);
                              echo "<tr><td>".$no."</td>
                              <td>".$row["kode_mk"]."</td>
                              <td>".$row["nama_mk"]."</td>
                              <td>".$row["nama_prodi"]."</td>";
                             	$request = $ws->prep_insert("InsertMataKuliah",$data);
                             	$ws_result = $ws->run($request);
                             	// $ws->view($ws_result);
                              if (!empty($ws_result[1]["data"]["id_matkul"])) {
                                  echo "<td>berhasil</td></tr>";
                                } else {echo "<td><span class='badge bg-red'>".$ws_result[1]["error_desc"]."</span></td></tr>";}
                              // .INSERT KE FEEDER

                           }

                      } else {
                           echo "0 results";
                      }
                      // $db->close();
                      ?>

            </div>
            <!-- /.box-body -->
          </div>




        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
