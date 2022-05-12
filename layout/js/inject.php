<?php 
if(isset($_GET['show']))
{$show=$_GET['show'];}
else{$show='yes';}
$act=$_GET['act'];
?>

<!-- Cek Progress ----------------------- -->
<script>
function checkIsOnline(inject, elemToShow, show,act){
$.ajax({
       url: "loaddatasync.php",
       type: "post",
       data: {module: inject,
              show: show,
              act: act,
            },
       success: function (response) {
        $("#"+elemToShow).html(response);
       },
       error: function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
       }
   });
}
setInterval(function(){
// MENAMPILKAN DATA SYNC lihat File LOADDATASYNC
<?php

      echo "checkIsOnline('".$module."','data".$act."','".$show."','".$act."');";

?>

}, 2000);
</script>

 <!-- checkIsOnline('mhskeluar','datamhskeluar','<?php echo $show;?>','');
 checkIsOnline('akm','dataakm','<?php echo $show;?>','');
 checkIsOnline('mk','datamk','<?php echo $show;?>','');
 checkIsOnline('<?php echo $module;?>','datamkkurikulum','<?php echo $show;?>','<?php echo $act;?>'); -->

