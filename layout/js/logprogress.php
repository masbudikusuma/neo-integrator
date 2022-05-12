<!-- Cek Progress ----------------------- -->
<script>
function checkIsOnline(target, elemToShow){
$.ajax({
       url: "cekprogress.php",
       type: "post",
       data: {ip: target},
       success: function (response) {
        // $("#"+elemToShow).text(response);
        $("#"+elemToShow).html(response);
        
        //  if(response == 'ok'){
        //    $("#"+elemToShow).text("PING OK");
        //      }else{
        //        $("#"+elemToShow).addClass('btn-danger');
        //        $("#"+elemToShow).text("PING TIMEOUT");
        //           }
       },
       error: function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
       }
   });
}
setInterval(function(){

checkIsOnline('172.20.2.42','logprogress');
}, 500);
</script>