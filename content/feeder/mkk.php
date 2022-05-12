<?php
$table = "getmatkulkurikulum";
$countneofeedermethod = "GetCountMatkulKurikulum";
$exec = "getMKKurikulum";

$jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
$jumlah = mysqli_query($db, $jumlah);
$x = mysqli_fetch_array($jumlah);
$total = $x['jumlah'];

$neofeeder = $ws->prep_get($countneofeedermethod);
        $neofeeder = $ws->run($neofeeder);
        $neofeeder = $neofeeder[1]["data"];
        
$sync = $weburl.'/exec.php?act='.$exec;
       
?>
<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="content-wrapper container">

<div class="page-content">
    <section class="row">
    <div class="col-12 col-lg-12">
                    <div class="page-heading">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h3><?php echo $ModuleName; ?></h3>
                            </div>
                            
                            <div class="card-body">
                            <div class="buttons">
                            
                            <!-- <div id="datamkhelper">  -->
                            <button type="button" class="btn btn-primary" >
                                Data NEO HELPER <span class="badge bg-transparent" id="datamkhelper"><?php echo $total; ?></span>
                            </button>
                            <!-- </div> -->
                            <button type="button" class="btn btn-success">
                            Data NEO FEEDER <span class="badge bg-transparent"><?php echo $neofeeder;?></span>
                            </button>
                            <a href="<?php echo $sync;?>" onClick="javascript:window.open('<?php echo $sync;?>','Windows','_blank','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,directories=no,status=no');return false")">
                            <button type="button" class="btn btn-danger">
                            IMPORT dari NEO FEEDER
                            </button></a>
                            <br>
                            *sumber data di neo-integrator
                        </div>

                                <!-- <?php echo $_SERVER['PHP_SELF']."?module=mhskeluarfeed"; ?>  -->
                                <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                <!-- <th scope="col">Aksi</th> -->
                                <th scope="col">Kurikulum</th>
                                <th scope="col">Kode MK</th>
                                <th scope="col">Nama Mata Kuliah</th>
                                <th scope="col">Nama Program Studi</th>
                                <th scope="col">Semester</th>
                                
                                </tr>
                                </thead>
                                <tbody>
                                <!-- List Data Menggunakan DataTable -->             
                                </tbody>
                                </table>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
    </div>  

    <!-- SIDEBAR -->
    
    
</div>
</section>

</div>
<script>
function checkIsOnline(hitung, elemToShow,table){
$.ajax({
       url: "hitung.php",
       type: "post",
       data: {module: hitung, table: table},
       success: function (response) {
        $("#"+elemToShow).html(response);
       },
       error: function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
       }
   });
}
setInterval(function(){
checkIsOnline('<?php echo $module;?>','datamkhelper','<?php echo $table;?>');
}, 5000);
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>       
      $(function(){
           $('.table').DataTable({
              "processing": true,
              "serverSide": true,
              "ajax":{
                       "url": "datatable.php?module=<?php echo $module;?>",
                       "dataType": "json",
                       "type": "POST"
                     },
              "columns": [
                { mData: 'nama_kurikulum' } ,
                { mData: 'kode_mata_kuliah' } ,
                { mData: 'nama_mata_kuliah' },
                { mData: 'nama_program_studi' },
                { mData: 'id_semester' },
              ]  
 
          });
        }); 
</script>