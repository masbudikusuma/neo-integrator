<?php
$sync = $weburl.'/exec.php?act=insertmhskeluar&tipe=minim';
// echo $sync;
?>


<ul class="pagination pagination-primary  justify-content-center">                      
<div class="buttons justify-content-center">    
    <div class="modal-success me-1 mb-1 d-inline-block"><br>
    <!-- <a href="index.php?module=inject&act=mhskeluar&run=true"  target = '_blank'> -->
    <a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">

    <!-- <a href="link" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")"> -->
      
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success">
    UPDATE ke NEO FEEDER NOW
    </button>
    </a>
    <!--Success theme Modal -->
    
</div>
</ul>

<!-- <tbody id="datamhskeluar"> -->
    <div id="datamhskeluarimport">
</div>
                    <!-- <div id="logprogress"> -->
                    </tbody>