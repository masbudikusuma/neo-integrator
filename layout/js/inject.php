<?php 
$show = isset($_GET['show']) ? $_GET['show'] : 'yes';
$act  = isset($_GET['act'])  ? $_GET['act']  : '';
$module = isset($module) ? $module : (isset($_GET['module']) ? $_GET['module'] : '');
?>

<!-- Cek Progress ----------------------- -->
<script>
function checkIsOnline(inject, elemToShow, show, act){
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
          console.error(textStatus, errorThrown);
       }
   });
}
setInterval(function(){
// MENAMPILKAN DATA SYNC lihat File LOADDATASYNC
checkIsOnline(<?php echo json_encode($module); ?>, <?php echo json_encode('data' . $act); ?>, <?php echo json_encode($show); ?>, <?php echo json_encode($act); ?>);
}, 2000);
</script>
