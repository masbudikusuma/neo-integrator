<?php
          $show = $_POST['show'];
          $berhasil=$belum=$sudahada=$gagal=0;
          $query = "select * from progress where act='InsertMahasiswaLulusDO'";
          $log = mysqli_query($db, $query);
          while($xlog = mysqli_fetch_array($log)){
            echo '<ul class="pagination pagination-primary  justify-content-center">                      
            <div class="buttons justify-content-center">';
            echo $xlog['keterangan']." - - Last time :".$xlog['update'];
            echo '</div></ul>';
          }

          
          
          $no = 1;
          if($show == 'yes'){
            $tampil = '<a href="?module=inject&act=mhskeluarimport&show=no"><button type="button" class="btn btn-danger">
            SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
          $query = "select * from insertmahasiswalulusdo";
          $hasil = mysqli_query($db, $query);
          if(mysqli_num_rows($hasil) > 0 ){
            echo "<table class='table table-striped'  border='1'><tr>
            <th>Baris</th><th>NIM</th><th>NAMA</th><th>ID Keluar</th><th>Tanggal Keluar</th><th>No Ijazah</th>
            <th>Error</th><th>Description</th></tr>";
            while($x = mysqli_fetch_array($hasil)){
              if ($x['err_no'] == '0' ){$berhasil++;}elseif(is_null($x['err_no'])){$belum++;}else{$gagal++;}
              // $jum
              echo "<tr><td>" . $no++;
            echo "</td><td>" . $x['nim'];echo "</td><td>" . $x['nama_mahasiswa'];
            echo "</td><td>" . $x['id_jenis_keluar'];echo "</td><td>" . $x['tanggal_keluar'];echo "</td><td>" . $x['nomor_ijazah'];
            echo "</td><td>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
            }
          } else {
            echo "Tidak Ada Data Yang Akan Di Sync";
          }
          $total=$berhasil+$belum+$gagal; 
          }else if($show == 'berhasil'){
                    $tampil = '<a href="?module=inject&act=mhskeluarimport&show=no"><button type="button" class="btn btn-danger">
                    SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
                    $query = "select * from insertmahasiswalulusdo where err_no='0'";
                    $hasil = mysqli_query($db, $query);
                    if(mysqli_num_rows($hasil) > 0 ){
                    echo "<table class='table table-striped'  border='1'><tr>
                    <th>Baris</th><th>NIM</th><th>NAMA</th><th>ID Keluar</th><th>Tanggal Keluar</th><th>No Ijazah</th>
                    <th>Error</th><th>Description</th></tr>";
                    while($x = mysqli_fetch_array($hasil)){
                    // $jum
                    echo "<tr><td>" . $no++;
                    echo "</td><td>" . $x['nim'];echo "</td><td>" . $x['nama_mahasiswa'];
                    echo "</td><td>" . $x['id_jenis_keluar'];echo "</td><td>" . $x['tanggal_keluar'];echo "</td><td>" . $x['nomor_ijazah'];
                    echo "</td><td>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
                    }
                    } else {
                    echo "Tidak Ada Data Yang Akan Di Sync";
                    }

                          $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
                          SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM insertmahasiswalulusdo;";
                          $hitung = mysqli_query($db, $query);
                          if(mysqli_num_rows($hitung) > 0 ){
                          $data = mysqli_num_rows($hitung);
                          while($hit = mysqli_fetch_array($hitung)){
                          $total=$hit['total'];
                          $belum=$hit['belum'];
                          $berhasil=$hit['berhasil'];
                          $gagal=$hit['gagal'];
                          }}

          }
          else if($show == 'gagal'){

                                    $tampil = '<a href="?module=inject&act=mhskeluarimport&show=no"><button type="button" class="btn btn-danger">
                                    SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
                                    $query = "select * from insertmahasiswalulusdo where err_no!='0' and err_no is not null";
                                    $hasil = mysqli_query($db, $query);
                                    if(mysqli_num_rows($hasil) > 0 ){
                                    echo "<table class='table table-striped'  border='1'><tr>
                                    <th>Baris</th><th>NIM</th><th>NAMA</th><th>ID Keluar</th><th>Tanggal Keluar</th><th>No Ijazah</th>
                                    <th>Error</th><th>Description</th></tr>";
                                    while($x = mysqli_fetch_array($hasil)){
                                    // $jum
                                    echo "<tr><td>" . $no++;
                                    echo "</td><td>" . $x['nim'];echo "</td><td>" . $x['nama_mahasiswa'];
                                    echo "</td><td>" . $x['id_jenis_keluar'];echo "</td><td>" . $x['tanggal_keluar'];echo "</td><td>" . $x['nomor_ijazah'];
                                    echo "</td><td>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
                                    }
                                    } else {
                                    echo "Tidak Ada Data Yang Akan Di Sync";
                                    }

                                    $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
                                    SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM insertmahasiswalulusdo;";
                                    $hitung = mysqli_query($db, $query);
                                    if(mysqli_num_rows($hitung) > 0 ){
                                    $data = mysqli_num_rows($hitung);
                                    while($hit = mysqli_fetch_array($hitung)){
                                    $total=$hit['total'];
                                    $belum=$hit['belum'];
                                    $berhasil=$hit['berhasil'];
                                    $gagal=$hit['gagal'];
                                    }}

          }
          else { //HANYA MENAMPILKAN PROSES, BUKAN DATA 
            $tampil = '<a href="?module=inject&act=mhskeluarimport"><button type="button" class="btn btn-primary">
            Tampilkan DATA <span class="badge bg-transparent"></span></button></a>';
            $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
            SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM insertmahasiswalulusdo;";
            $hitung = mysqli_query($db, $query);
            if(mysqli_num_rows($hitung) > 0 ){
              $data = mysqli_num_rows($hitung);
            while($hit = mysqli_fetch_array($hitung)){
              $total=$hit['total'];
              $belum=$hit['belum'];
              $berhasil=$hit['berhasil'];
              $gagal=$hit['gagal'];
            }}
          }


          echo '<div class="card-body">
                        <div class="buttons">
                            <button type="button" class="btn btn-primary">
                                Jumlah Data <span class="badge bg-transparent">'.$total.'</span>
                            </button>
                            <button type="button" class="btn btn-primary">
                                Belum Sync <span class="badge bg-transparent">'.$belum.'</span>
                            </button>
                            <a href="?module=inject&act=mhskeluarimport&show=berhasil">
                            <button type="button" class="btn btn-success">
                                Berhasil <span class="badge bg-transparent">'.$berhasil.'</span>
                            </button></a>
                            
                            <button type="button" class="btn btn-success">
                                Sudah Ada <span class="badge bg-transparent">'.$sudahada.'</span>
                            </button>
                            <a href="?module=inject&act=mhskeluarimport&show=gagal">
                            <button type="button" class="btn btn-danger">
                                Gagal Insert <span class="badge bg-transparent">'.$gagal.'</span>
                            </button></a>
                            '.$tampil.'
                            
                            </div>
                            </div>';
                            ?>