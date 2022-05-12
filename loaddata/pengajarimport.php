<?php
          $show = $_POST['show'];
          $namatable = "insertpengajarkelas";
          $act="pengajarimport";
          $berhasil=$belum=$sudahada=$gagal=0;
          $query = "select * from progress where act='InsertPengajarKelasKuliah'";
          $log = mysqli_query($db, $query);
          while($xlog = mysqli_fetch_array($log)){
            echo '<ul class="pagination pagination-primary  justify-content-center">                      
            <div class="buttons justify-content-center">';
            echo $xlog['keterangan']." - - Last time :".$xlog['update'];
            echo '</div></ul>';
          }

          $headertable = "<table class='table table-striped'  border='1'><tr>
          <th>No</th><th>ID Kelas</th><th>ID Reg Dosen</th><th>NIDN</th><th>Kode MK</th><th>Kelas</th>
          <th>Semester</th><th>SKS</th><th>Error</th><th>Description</th></tr>";
          
          $no = 1;
          if($show == 'yes'){
            $tampil = '<a href="?module=inject&act='.$act.'&show=no"><button type="button" class="btn btn-danger">
            SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
          $query = "select * from ".$namatable;
          $hasil = mysqli_query($db, $query);
          if(mysqli_num_rows($hasil) > 0 ){
                    echo $headertable;
                    while($x = mysqli_fetch_array($hasil)){
                    if ($x['err_no'] == '0' ){$berhasil++;}elseif(is_null($x['err_no'])){$belum++;}else{$gagal++;}
                    echo "<tr><td><pre>" . $no++;
                    echo "</td><td><pre>" . $x['id_kelas_kuliah'];echo "</td><td><pre>" . $x['id_registrasi_dosen'];
                    echo "</td><td><pre>" . $x['nidn'];echo "</td><td><pre>" . $x['kode_mk'];
                    echo "</td><td><pre>" . $x['kode_kelas'];
                    echo "</td><td><pre>" . $x['id_semester'];echo "</td><td><pre>" . $x['sks_substansi_total'];
                    echo "</td><td><pre>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
                    }
          } else {
                    echo "Tidak Ada Data Yang Akan Di Sync";
          }
          $total=$berhasil+$belum+$gagal; 
          }else if($show == 'berhasil'){
                    $tampil = '<a href="?module=inject&act='.$act.'&show=no"><button type="button" class="btn btn-danger">
                    SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
                    $query = "select * from ".$namatable." where err_no='0'";
                    $hasil = mysqli_query($db, $query);
                    if(mysqli_num_rows($hasil) > 0 ){
                    echo $headertable;
                    while($x = mysqli_fetch_array($hasil)){
                    // $jum
                    echo "<tr><td>" . $no++;
                    echo "</td><td><pre>" . $x['id_kelas_kuliah'];echo "</td><td><pre>" . $x['id_registrasi_dosen'];
                    echo "</td><td><pre>" . $x['nidn'];echo "</td><td><pre>" . $x['kode_mk'];
                    echo "</td><td><pre>" . $x['kode_kelas'];
                    echo "</td><td><pre>" . $x['id_semester'];echo "</td><td><pre>" . $x['sks_substansi_total'];
                    echo "</td><td><pre>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
                    }
                    } else {
                    echo "Tidak Ada Data yang berhasil";
                    }

                          $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
                          SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM ".$namatable.";";
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

                                    $tampil = '<a href="?module=inject&act='.$act.'&show=no"><button type="button" class="btn btn-danger">
                                    SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
                                    $query = "select * from ".$namatable." where err_no!='0' and err_no is not null";
                                    $hasil = mysqli_query($db, $query);
                                    if(mysqli_num_rows($hasil) > 0 ){
                                    echo $headertable;
                                    while($x = mysqli_fetch_array($hasil)){
                                    // $jum
                                    echo "<tr><td>" . $no++;
                    echo "</td><td><pre>" . $x['id_kelas_kuliah'];echo "</td><td><pre>" . $x['id_registrasi_dosen'];
                    echo "</td><td><pre>" . $x['nidn'];echo "</td><td><pre>" . $x['kode_mk'];
                    echo "</td><td><pre>" . $x['kode_kelas'];
                    echo "</td><td><pre>" . $x['id_semester'];echo "</td><td><pre>" . $x['sks_substansi_total'];
                    echo "</td><td><pre>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
                                    }
                                    } else {
                                    echo "Tidak Ada Data gagal";
                                    }

                                    $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
                                    SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM ".$namatable.";";
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
          else if($show == 'belum'){

            $tampil = '<a href="?module=inject&act='.$act.'&show=no"><button type="button" class="btn btn-danger">
            SEMBUNYIKAN DATA <span class="badge bg-transparent"></span></button></a>';
            $query = "select * from ".$namatable." where err_no is null";
            $hasil = mysqli_query($db, $query);
            if(mysqli_num_rows($hasil) > 0 ){
            echo $headertable;
            while($x = mysqli_fetch_array($hasil)){
            // $jum
            echo "<tr><td>" . $no++;
                    echo "</td><td><pre>" . $x['id_kelas_kuliah'];echo "</td><td><pre>" . $x['id_registrasi_dosen'];
                    echo "</td><td><pre>" . $x['nidn'];echo "</td><td><pre>" . $x['kode_mk'];
                    echo "</td><td><pre>" . $x['kode_kelas'];
                    echo "</td><td><pre>" . $x['id_semester'];echo "</td><td><pre>" . $x['sks_substansi_total'];
                    echo "</td><td><pre>" . $x['err_no'];echo "</td><td><code>" . $x['err_desc'] . "</code></td></tr>";
            }
            } else {
            echo "Tidak Ada yang belum di SYNC";
            }

            $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
            SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM ".$namatable.";";
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
            $tampil = '<a href="?module=inject&act='.$act.'"><button type="button" class="btn btn-primary">
            Tampilkan DATA <span class="badge bg-transparent"></span></button></a>';
            $query = "SELECT count(id) AS total, sum(err_no IS NULL) AS belum, SUM(err_no='0') AS berhasil,
            SUM(err_no IS NOT NULL AND err_no!='0') AS gagal FROM ".$namatable.";";
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
                            <a href="?module=inject&act='.$act.'">
                            <button type="button" class="btn btn-primary">
                                Jumlah Data <span class="badge bg-transparent">'.$total.'</span>
                            </button></a>
                            <a href="?module=inject&act='.$act.'&show=belum">
                            <button type="button" class="btn btn-primary">
                                Belum Sync <span class="badge bg-transparent">'.$belum.'</span>
                            </button></a>
                            <a href="?module=inject&act='.$act.'&show=berhasil">
                            <button type="button" class="btn btn-success">
                                Berhasil <span class="badge bg-transparent">'.$berhasil.'</span>
                            </button></a>
                            
                            <button type="button" class="btn btn-success">
                                Sudah Ada <span class="badge bg-transparent">'.$sudahada.'</span>
                            </button>
                            <a href="?module=inject&act='.$act.'&show=gagal">
                            <button type="button" class="btn btn-danger">
                                Gagal Insert <span class="badge bg-transparent">'.$gagal.'</span>
                            </button></a>
                            '.$tampil.'
                            
                            </div>
                            </div>';
                            ?>