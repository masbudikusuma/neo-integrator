<?php
include "component/config.php";


if(isset($_GET['module'])){$module=$_GET['module'];}else{$module='no';}
// if(isset($GET['table'])){$table=$_GET['table'];}else{$table='no';}
          
if ($module!="no"){
  include "loaddata/data_".$module.".php";

}
         

                            ?>