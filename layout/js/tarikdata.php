<?php
$feederHost = !empty($urlfeeder) ? parse_url($urlfeeder, PHP_URL_HOST) : 'localhost';
if (empty($feederHost)) {
    $feederHost = 'localhost';
}
?>
<!-- Cek Progress ----------------------- -->
<script>
function checkIsOnline(target, elemToShow){
$.ajax({
       url: "tarikdata.php",
       type: "post",
       data: {ip: target},
       success: function (response) {
        $("#"+elemToShow).html(response);
       },
       error: function(jqXHR, textStatus, errorThrown) {
          console.error(textStatus, errorThrown);
       }
   });
}
setInterval(function(){
    checkIsOnline(<?php echo json_encode($feederHost); ?>, 'logprogress');
}, 4000);
</script>
