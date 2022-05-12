<?php 
if(isset($_GET['show']))
{$show=$_GET['show'];}
else{$show='yes';}
?>
<!-- Cek Progress ----------------------- -->
<script>
function checkIsOnline(inject, elemToShow, show){
$.ajax({
       url: "?module=hitung",
       type: "post",
       data: {module: inject,
              show: show},
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
// checkIsOnline('mhskeluar','datamhskeluar','<?php echo $show;?>');
// checkIsOnline('akm','dataakm','<?php echo $show;?>');
checkIsOnline('mk','datamk','<?php echo $show;?>');
}, 2000);
</script>
