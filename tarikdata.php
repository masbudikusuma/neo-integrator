<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['session']) || empty($_SESSION['session'])) {
    http_response_code(403);
    die("Akses ditolak");
}

include "component/config.php";

$host = isset($_POST['ip']) && !empty($_POST['ip']) ? $_POST['ip'] : parse_url($urlfeeder, PHP_URL_HOST);
if (empty($host)) {
    $host = 'localhost';
}
$port = parse_url($urlfeeder, PHP_URL_PORT) ?: 8100;
$waitTimeoutInSeconds = 1;

$table = array(
  array("getmahasiswa","GetListMahasiswa","wajib ditarik","getMahasiswa"),
  array("getdosen","DetailBiodataDosen","wajib ditarik","getDosen"),
  array("getprodi","GetProdi","wajib ditarik","getProdi"),
  array("getmatakuliah","GetDetailMataKuliah","wajib ditarik","getMataKuliah"),
  array("getkurikulum","GetListKurikulum","wajib ditarik","getKurikulum"),
  array("getmatkulkurikulum","GetMatkulKurikulum","wajib ditarik","getMKKurikulum"),
  array("getkelaskuliah","GetDetailKelasKuliah","wajib ditarik","getKelasKuliah"),
  array("getpengajarkelas","GetDosenPengajarKelasKuliah","wajib ditarik","getPengajarKelas"),
  array("getpesertakelas","GetPesertaKelasKuliah","tidak wajib","getPesertaKelas"),
  array("getnilaikuliahkelas","GetRiwayatNilaiMahasiswa","tidak wajib","getNilaiKuliah"),
  array("getakm","GetListPerkuliahanMahasiswa","tidak wajib","getAKM"),
  array("getmahasiswalulusdo","GetDetailMahasiswaLulusDO","tidak wajib","")
);

$fp = @fsockopen($host, $port, $errCode, $errStr, $waitTimeoutInSeconds);
if ($fp) {
    fclose($fp);

    for ($i = 0; $i < count($table); $i++) {
        $tableName = $table[$i][0];
        $actName = $table[$i][1];
        $keterangan = $table[$i][2];
        $execAct = $table[$i][3];
        $sync = $weburl . '/exec.php?act=' . $execAct;

        $query = "SELECT COUNT(id) as jumlah FROM `" . $tableName . "`";
        $hasil = mysqli_query($db, $query);
        $jumlahData = 0;
        $adaData = false;

        if ($hasil && mysqli_num_rows($hasil) > 0) {
            $x = mysqli_fetch_array($hasil);
            $jumlahData = $x['jumlah'];
            $adaData = ($jumlahData > 0);
        }

        $query2 = "SELECT keterangan FROM progress WHERE act = ?";
        $stmt2 = mysqli_prepare($db, $query2);
        $progressKet = 'kosong';
        if ($stmt2) {
            mysqli_stmt_bind_param($stmt2, "s", $actName);
            mysqli_stmt_execute($stmt2);
            $hasil2 = mysqli_stmt_get_result($stmt2);
            if ($hasil2 && $y = mysqli_fetch_array($hasil2)) {
                $progressKet = $y['keterangan'];
            }
            mysqli_stmt_close($stmt2);
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($tableName, ENT_QUOTES, 'UTF-8') . "</td>";
        if ($adaData) {
            echo "<td><pre>" . htmlspecialchars((string)$jumlahData, ENT_QUOTES, 'UTF-8') . "</pre></td>";
        } else {
            echo "<td><code>Data kosong</code></td>";
        }
        echo "<td>" . htmlspecialchars($actName, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>progress " . htmlspecialchars($progressKet, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td><pre>" . htmlspecialchars($keterangan, ENT_QUOTES, 'UTF-8') . "</pre></td>";

        $btnClass = $adaData ? "btn btn-success rounded-pill btn-sm" : "btn btn-danger btn-sm";
        $btnText  = $adaData ? "Tarik data" : "IMPORT dari NEO FEEDER";
        $urlSync  = htmlspecialchars($sync, ENT_QUOTES, 'UTF-8');

        echo "<td>";
        if (!empty($execAct)) {
            echo "<a href='{$urlSync}' onclick=\"window.open('{$urlSync}','Windows','width=650,height=350,toolbar=no,menubar=no,scrollbars=yes,resizable=yes'); return false;\">";
            echo "<button type='button' class='{$btnClass}'>{$btnText}</button>";
            echo "</a>";
        } else {
            echo "<span class='text-muted'>-</span>";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center text-danger'><strong>Feeder OFF atau tidak dapat dijangkau pada {$host}:{$port}</strong></td></tr>";
}
?>