
<?php
$table = "getakm";
$countneofeedermethod = "GetCountPerkuliahanMahasiswa";
$exec = "getAKM";

$jumlah = "SELECT COUNT(*) as jumlah FROM ".$table;
$jumlah = mysqli_query($db, $jumlah);
$x = mysqli_fetch_array($jumlah);
$total = $x['jumlah'];

$neofeeder = $ws->prep_get($countneofeedermethod);
        $neofeeder = $ws->run($neofeeder);
        $neofeeder = $neofeeder[1]["data"];
        // $neofeeder = "coming soon";
        
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
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Program Studi</th>
                                <th scope="col">Semester</th>
                                <th scope="col">IPK</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Status</th>
                                <th scope="col">Biaya</th>
                                
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
                { mData: 'nim' } ,
                { mData: 'nama_mahasiswa' } ,
                { mData: 'nama_program_studi' },
                { mData: 'id_semester' },
                { mData: 'ipk' },
                { mData: 'sks_total' },
                { mData: 'nama_status_mahasiswa' },
                { mData: 'biaya_kuliah_smt' },
                // { mData: 'id_semester' },
              ]  
 
          });
        }); 
</script>
