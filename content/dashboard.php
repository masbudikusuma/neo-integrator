<div class="content-wrapper container">
                
                <!-- <div class="page-heading">
                    <h3>DATA FEEDER</h3>
                </div> -->

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold"> Mahasiswa</h6>
                                    <h6 class="font-extrabold mb-0"><?php jmlmhs($jmlmhs); echo $jmlmhs; ?> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold"> AKM Detail</h6>
                                    <h6 class="font-extrabold mb-0"><?php jmlakmsmt($jmlakm,"20201"); echo $jmlakm; ?> </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah AKM</h6>
                                    <h6 class="font-extrabold mb-0"><?php jmlakm($jmlakm); echo $jmlakm; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jumlah Dosen</h6>
                                    <h6 class="font-extrabold mb-0"><?php jmldosen($jmldosen); echo $jmldosen; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Mhs Keluar</h6>
                                    <h6 class="font-extrabold mb-0"><?php jmllulus($jmllulus); echo $jmllulus; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                        <h4>Pembukaan Periode Lampau</h4>
                            <div class="table-responsive">
                                <table class="table table-hover table-light mb-0">
                                <thead><tr><th>Kode Prodi</th><th>Nama Prodi</th><th>Tipe</th><th>Periode</th></tr></thead>
                                <tbody>
                                <?php 
                                $dataf = array();
                                get_PeriodeLampau($dataf); 
                                $dataf = json_decode($dataf, TRUE);
                                if (is_array($dataf)){
                                foreach ($dataf as $key){
                                foreach ($key as $key2){     
                                foreach ($key2 as $datafss){     
                                echo "<tr>
                                <td >".$datafss['kode_prodi']."</td>
                                <td >".$datafss['nm_lemb']."</td>
                                <td >".$datafss['tipe']."</td>
                                <td >".$datafss['nm_smt']."
                                </tr>";
                                } } } }                   
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
<!--  -->

            <div class="row">
                <div class="col-6">
                    <div class="card">
                    <div class="card-header">
                    <h4>Log Sync Neo-feeder</h4>
                    </div>
                    <div class="card-body">
                    <!-- <div class="table-responsive"> -->
                    <table style='font-family:"Courier New", Courier, monospace; font-size:80%' class='table' >
                    <thead><tr><th>Tanggal</th><th>Durasi</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php 
                    $dataf = array();
                    get_LogSync($dataf); 
                    $dataf = json_decode($dataf, TRUE);
                    if (is_array($dataf)){  foreach ($dataf as $key){
                    if (is_array($key)){    foreach ($key as $key2){    
                    if (is_array($key2)){   foreach ($key2 as $datafss){     
                    if ($datafss['is_success'] == 1){$status = "berhasil";}else{$status="gagal";}
                    echo "<tr>
                    <td>".str_replace("T"," ",substr($datafss['begin_sync'],0,19))."</td>
                    <td vertical-align='middle'>".substr($datafss['durasi'],0,8)."</td>
                    <td >".$status."</td>
                    </tr>";
                    } }     } }     } }    
                    ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            <!-- </div> -->

            <!-- <div class="row"> -->
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Rekap AKM</h4>
                        </div>
                        <div class="card-body">
                            Rekap AKM Versi Neo-Integrator, Berisi Rekap AKM dan Dosen Mengajar tiap Semester dan tiap program studi.<br><br>
                            Mempermudah dalam melakukan pemantauan data masing-masing program studi
                            <div id="chart-profile-visit"></div>
                            <a href="index.php?module=checkpoint"><button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Rekap AKM</button></a>
                        </div>
                    </div>
                </div>
            </div>

            
                

            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
            <div class="card-header">
                    <h4>Aplikasi Neo Feeder</h4>
                    <table style='font-family:"Courier New", Courier, monospace; font-size:80%' class='table' >
                                <thead><tr><th>Detail</th><th>Keterangan</th></tr></thead>
                                <tbody>
                                <?php 
                                $dataf = array();
                                get_AppVersion($dataf); 
                                $dataf = json_decode($dataf, TRUE);
                                // print_r($dataf);
                                echo "
                    <tr><td> Nama Aplikasi  </td><td>".$dataf['app_name']."</br></td></tr>
                    <tr><td> Versi Aplikasi  </td><td>".$dataf['app_version']."</br></td></tr>
                    <tr><td> sync_version  </td><td>".$dataf['app_version']."</br></td></tr>
                    <tr><td> Expired        </td><td>".$dataf['app_expired_date']."</br></td></tr>
                    <tr><td> Installer  </td><td>".$dataf['installer']."</br></td></tr>";     
                                ?>
                                </tbody>
                                </table>
            </div>
            </div>
            <div class="card">
                <div class="card-header">            
                    <h4>Tarik Data </h4>    
                    <!-- <div class="card-content pb-4"> -->
                        <!-- <div class="px-4"> -->
                        Untuk mengambil data Neo-Feeder untuk di simpan ke Neo_integrator
                        <br><br>
                        fungsi : untuk proses inject yang membutuhkan UUID
                        <a href="index.php?module=tarikdata"><button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Tarik Data</button></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">            
                    <h4>Neo Integrator </h4>    
                    <table style='font-family:"Courier New", Courier, monospace; font-size:80%' class='table' >
                                <thead><tr><th>Detail</th><th>Keterangan</th></tr></thead>
                                <tbody>
                                <?php 
                                echo "
                    <tr><td> Nama Aplikasi  </td><td>".$system_desc."</br></td></tr>
                    <tr><td> Versi Aplikasi  </td><td>".$system_version."</br></td></tr>
                    <tr><td> Telegram Group        </td><td><a href='https://t.me/+0VWcv9E-Kc82NjNl'>Link</a></td></tr>
                    <tr><td> GitHub        </td><td><a href='https://github.com/masbudikusuma/Neo-Integrator'>Link</a></td></tr>
                    <tr><td> Support Us</td><td><a href='https://www.nihbuatjajan.com/neoin'>Link</a></td></tr>";     
                                ?>
                                </tbody>
                                </table>
                </div>
            </div>
            
        </div>
    </section>
</div>
</div>