<?php
include_once 'component/config.php';
ob_start(); $buffer = str_repeat("", 4096)."\r\n<span></span>\r\n"; //show progress
$now = new DateTime();
echo "<h4>JANGAN TUTUP BROWSER INI HINGGA PROSES SELESAI</h4>";
$closebrowser = '<br><b>Proses Selesai</b><br><button onclick="self.close()">Close</button>';
if (isset($_GET['act'])){$act  = $_GET['act'];} else {$act=1;}

switch ($act) {
    case "cekMahasiswa":        include "ws/cekMahasiswa.php";break;
    
    case "cekBiodata":          include "ws/cekBiodataMHS.php";break;
    
    case "getMahasiswa":        include "ws/getMahasiswa.php";break;
    
    case "getDosen":        include "ws/getDosen.php";break;
    
    case "insertMahasiswa":     include "ws/insertMahasiswa.php";  break;

    case "getProdi":            include "ws/getProdi.php";  break;

    case "getAllProdi":            include "ws/getAllProdi.php";  break;

    case "getPenugasanDosen":   include "ws/getPenugasanDosen.php";  break;

    case "cekMataKuliah":       include "ws/cekMataKuliah.php";break;

    case "getMataKuliah":        include "ws/getMataKuliah.php";  break;

    case "insertMataKuliah":    include "ws/insertMataKuliah.php";break;

    case "insertKelasKuliah":   include "ws/insertKelasKuliah.php";break;
      
    case "getKelasKuliah":      include "ws/getKelasKuliah.php";break;
    
    case "insertPesertaKelas":  include "ws/insertPesertaKelas.php";break;

    case "insertNilaiKuliah":  include "ws/insertNilaiKuliah.php";break;

    case "getPesertaKelas":  include "ws/getPesertaKelas.php";break;

    case "getPengajarKelas":    include "ws/getPengajarKelas.php";break;

    case "insertPengajarKelas": include "ws/insertPengajarKelas.php";break;

    case "insertAKM":           include "ws/insertAKM.php";break;
    
    case "updateAKM":           include "ws/updateAKM.php";  break;

    case "getAKM":              include "ws/getAKM.php";break;
    
    case "getNilaiKuliah":      include "ws/getNilaiKuliah.php";break;

    case "getKurikulum":        include "ws/getKurikulum.php";    break;

    case "getMKKurikulum":      include "ws/getmataKuliahKurikulum.php";break;

    case "insertmhskeluar":     include "ws/insertMahasiswaLulusDO.php";  break;
    
    case "updateMahasiswa":     include "ws/updateMahasiswa.php";  break;
    
    case "output":              include "ws/output.php";break;

    case "dict":                include "ws/getDict.php";break;
    default:
      echo "act is not list, cek exec.php";
  }
  
  ob_end_flush(); //end show progress
  $future_date = new DateTime();
  $interval = $future_date->diff($now);
  echo "<br><b>Waktu Eksekusi</b> : &nbsp ".(($interval->format("%a") * 24) + $interval->format("%H")). " Jam ". $interval->format("%I Menit"). $interval->format(" %S Detik");
  echo $closebrowser;
?>