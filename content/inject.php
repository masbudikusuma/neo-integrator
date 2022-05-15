<?php if (isset($_GET['act'])){$act  = $_GET['act'];} else {$act=1;}?>
<div class="content-wrapper container">
<div class="page-content">
    <section class="row">
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Inject DATA to NEO-FEEDER</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    

    <section class="section">
        <div class="card">
            <?php
switch ($act) {
    case "mhskeluarimport":     $name = "MAHASISWA KELUAR (LULUS/DO/MENGUNDURKAN DIRI)";    include "content/inject/mhskeluar.php";break;
    case "akmimport":           $name = "AKTIVITAS KULIAH MAHASISWA";                       include "content/inject/akmimport.php";break;
    case "mkimport":            $name = "MATA KULIAH";                                      include "content/inject/mk.php";break;
    case "mkkimport":           $name = "MATA KULIAH KURIKULUM";                            include "content/inject/mkkurikulum.php";break;
    case "kelasimport":         $name = "KELAS KULIAH";                                     include "content/inject/kelaskuliah.php";break;
    case "pengajarimport":      $name = "PENGAJAR KELAS KULIAH";                            include "content/inject/pengajar.php";break;
    case "pesertaimport":       $name = "PESERTA KELAS KULIAH";                             include "content/inject/peserta.php";break;  
    case "nilaiimport":       $name = "Nilai Kelas Kulah";                             include "content/inject/nilai.php";break;  
    case "updateMahasiswa":     $name = "UPDATE MAHASISWA";                                   include "content/inject/updatemhs.php";break;
    case "mhsimport":     $name = "MAHASISWA Baru";                                   include "content/inject/mhs.php";break;
    case "cekBiodata":          $name = "Cek biiodata MAHASISWA";                                   include "ws/cekBiodataMHS.php";break;
    
      case "getMahasiswa":
      include "ws/getMahasiswa.php";break;
      default:
      echo "act is not list, cek content/inject.php";
  }
            ?>
        </div>

    </section>
</div>

</section>
</div>
</div>