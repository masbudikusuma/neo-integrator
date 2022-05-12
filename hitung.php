<?php
include "component/config.php";


if(isset($_POST['module'])){$module=$_POST['module'];}else{$module='no';}
if(isset($_POST['table'])){$table=$_POST['table'];}else{$table='no';}
          
if ($module!="no"){
  $jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
    $jumlah = mysqli_query($db, $jumlah);
    $x = mysqli_fetch_array($jumlah);   
    echo $x['jumlah'];

// switch($module){
//   case "feedmk":
//     $jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
//     $jumlah = mysqli_query($db, $jumlah);
//     $x = mysqli_fetch_array($jumlah);   
//     echo $x['jumlah'];
//     break;

//         default:
// }
}
         

                            ?>