<?php
include "component/config.php";
if(isset($_POST['ip'])){
$host = $_POST['ip'];
$port = 8100; 
$waitTimeoutInSeconds = 1; 


$table = array(
  array("getmahasiswa","GetListMahasiswa","wajib ditarik","getMahasiswa"),
  array("getdosen","DetailBiodataDosen","wajib ditarik","getDosen"),
  array("getprodi","GetProdi","wajib ditarik","getProdi"),
  array("getmatakuliah","GetDetailMataKuliah","wajib ditarik","getMataKuliah"),
  array("getkurikulum","GetListKurikulum","wajib ditarik","getKurikulum"),
  array("getmatkulkurikulum","GetMatkulKurikulum","wajib ditarik","getMKKurikulum"),
  array("getkelaskuliah","GetDetailKelasKuliah","wajib ditarik","getKelasKuliah"),
  array("getpengajarkelas","GetDosenPengajarKelasKuliah","wajib ditarik","getPengajarKelas"),
  array("getpesertakelas","GetPesertaKelasKuliah","tidak wajib","getPesertaKelas"),
  array("getnilaikuliahkelas","GetRiwayatNilaiMahasiswa","tidak wajib","getNilaiKuliah"),
  array("getakm","GetListPerkuliahanMahasiswa","tidak wajib","getAKM"),
  array("getmahasiswalulusdo","GetDetailMahasiswaLulusDO","tidak wajib",""));

for ($i=0;$i<=11;$i++){
  $sync = $weburl.'app/exec.php?act='.$table[$i][3];
   
  echo "data " . $table[$i][1];
  $query = "SELECT COUNT(id) as jumlah from  ".$table[$i][0];
  $hasil = mysqli_query($db, $query);
  if(mysqli_num_rows($hasil) > 0 ){
  while($x = mysqli_fetch_array($hasil)){
    echo "<tr><td>".$table[$i][0]."</td><td><pre>".$x['jumlah']."</td><td>".$table[$i][1]."</td> 
</td>";
// print_r($table[$i][1]);


            $query2 = "SELECT * from  progress where  act='".$table[$i][1]."'";
            echo $query2;
            $hasil2 = mysqli_query($db, $query2);
            if(mysqli_num_rows($hasil2) > 0 ){
            while($y = mysqli_fetch_array($hasil2)){
            echo "<td>progress ".$y['keterangan']."</td><td><pre>".$table[$i][2]."</td>";
            ?>
            <td><a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-success rounded-pill btn-sm">
                            Tarik data
                            </button></a></td></tr>
                            <?php
            }} else {
            echo "<td>progress kosong</td><td><pre>".$table[$i][2]."</td>";
            ?>
            <td><a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
            <button type="button" class="btn btn-success rounded-pill btn-sm">
                            Tarik data
                            </button></a></td></tr>
                            <?php
            }

  }
}else {
  echo "<tr><td>".$table[$i][0]."</td><td><code>Data kosong</code></td><td>".$table[$i][1]."</td>";
            $query2 = "SELECT * from  progress where  act='".$table[$i][1]."'";
            echo $query2;
            $hasil2 = mysqli_query($db, $query2);
            if(mysqli_num_rows($hasil2) > 0 ){
            while($y = mysqli_fetch_array($hasil2)){
            echo "<td>progress ".$y['keterangan']."</td><td><pre>".$table[$i][2]."</td>";
            ?>
            <td><a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-danger">
                            IMPORT dari NEO FEEDER
                            </button></a></td></tr>
                            <?php
            }} else {
            echo "<td>progress kosong</td><td><pre>".$table[$i][2]."</td>";
            ?>
            <td><a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-danger">
                            IMPORT dari NEO FEEDER
                            </button></a></td></tr>
                            <?php
            }
}
}

} 

else {
  echo "Feeder OFF";
} 




// fclose($fp);


?>