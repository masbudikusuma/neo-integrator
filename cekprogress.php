<?php
include "component/config.php";
if(isset($_POST['ip'])){
$host = $_POST['ip'];
$port = 8100; 
$waitTimeoutInSeconds = 1; 


if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
  $query = "SELECT * from progress where used='yes' order by progress.update desc";
  $hasil = mysqli_query($db, $query);
  if(mysqli_num_rows($hasil) > 0 ){
  while($x = mysqli_fetch_array($hasil)){
    
    echo "<tr><td><pre>".$x['update']."&nbsp;&nbsp;</td><td><pre>".$x['act']." &nbsp;</td> 
    <td><pre>".$x['keterangan']."</td><td><pre>
    <span class='badge bg-success'>Active</span>
</td></tr>";

  }}

} else {
  echo "Feeder OFF";
} 

fclose($fp);

}
?>