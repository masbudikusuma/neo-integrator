<?php
$sync = $weburl.'/exec.php?act=updateMahasiswa&tipe=minim'; //cek di exec.php dan ws/insertMataKuliah
?>

<ul class="pagination pagination-primary  justify-content-center">                      
<div class="buttons justify-content-center">    
    <div class="modal-success me-1 mb-1 d-inline-block"><br>
    <a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">     
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success">
    INSERT <?php echo $name;?> FEEDER NOW
    </button>
    </a>
</div>
</ul>
<!-- <tbody id="datamhskeluar"> -->
<div id="<?php echo "data".$act;?>"> <!-- Cek di Layout/js/Inject.php -->
</div>
                    <!-- <div id="logprogress"> -->
                    </tbody>