<meta http-equiv="refresh" content="120" >
<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<div class="content-wrapper container">

<div class="page-content">
    <section class="row">
    <div class="col-12 col-lg-12">
                    <div class="page-heading">


<div class="content-wrapper container">
<div class="page-content">
    <section class="row">
<div class="page-heading">
    <section class="section">
        <div class="card">
        <div class="card-header">
                                <h3><?php echo $ModuleName;
                                $max_time = ini_get('max_execution_time');
                                echo $max_time; ?></h3>
                                
keterangan : <br>
<pre>Tarik Data ditujukan untuk mempercepat proses pencarian UUID ketika proses Inject / Pencarian Data
kecepatan tarik data tergantung kondisi koneksi antara Neo Integrator dengan Neo Feeder dan spesifikasi Server Neo-Feedernya
Tarik Data cukup dilakukan sekali di masing-masing Table, yang terdapat keterangan wajib ditarik.
untuk melakukan tarik data secara paralel, klik kanan Tarik Data, lalu pilih open new tab
</pre>
                            </div>

            <div class="card-body">
                <table class="table table-light mb-0" id="table1">
                    <thead>
                        <tr>
                            <th>Table</th>
                            <th>Jumlah Record</th>
                            <th>Act Module</th>
                            <th>Progress Status</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="logprogress">
                    <!-- <div id="logprogress"> -->
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

</section>
</div>
</div>