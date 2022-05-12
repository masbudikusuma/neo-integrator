<?php
include "component/config.php";

if(isset($_POST['module'])){
$module = $_POST['module'];
$act=$_POST['act'];

include "loaddata/".$act.".php";
  // switch ($module) {
  //   case "mhskeluar": include "loaddata/mhskeluar.php";     break;
  //   case "akm":       include "loaddata/akm.php";     break;
  //   case "mk":       include "loaddata/mk.php";     break;
  //   case $act:       include "loaddata/".$act.".php";     break;
    

  //   case "pesertakelas":
  //     $no = 0;
  //         $query = "select * from insertpesertakelas";
  //         $hasil = mysqli_query($db, $query);
  //         if(mysqli_num_rows($hasil) > 0 ){
  //           echo "<table class='table table-striped'  border='1'><tr>
  //           <th>Baris</th><th>NIM</th><th>NAMA</th><th>ID Keluar</th><th>No Ijazah</th>
  //           <th>Error</th><th>Description</th></tr>";
  //           while($x = mysqli_fetch_array($hasil)){
  //             echo "<tr><td>" . $no++;
  //           echo "</td><td>" . $x['nim'];echo "</td><td>" . $x['id_kelas_kuliah'];
  //           echo "</td><td>" . $x['id_registrasi_mahasiswa'];echo "</td><td>" . $x['nim'];
  //           echo "</td><td>" . $x['err'];echo "</td><td><code>" . $x['desc'] . "</code></td></tr>";
  //           }
  //         } else {
  //           echo "Tidak Ada Data Yang Akan Di Sync";
  //         } 
  //     break;

  //   default:
  //     // "echo "act is not list, cek exec.php";"
  // }
}
  
?>