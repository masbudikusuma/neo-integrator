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

$fp = @fsockopen($host, $port, $errCode, $errStr, $waitTimeoutInSeconds);
if ($fp) {
    fclose($fp);
    $query = "SELECT * FROM progress WHERE used='yes' ORDER BY `update` DESC";
    $hasil = mysqli_query($db, $query);
    if ($hasil && mysqli_num_rows($hasil) > 0) {
        while ($x = mysqli_fetch_array($hasil)) {
            echo "<tr><td><pre>" . htmlspecialchars($x['update'], ENT_QUOTES, 'UTF-8') . "&nbsp;&nbsp;</td><td><pre>" . htmlspecialchars($x['act'], ENT_QUOTES, 'UTF-8') . " &nbsp;</td> 
            <td><pre>" . htmlspecialchars($x['keterangan'], ENT_QUOTES, 'UTF-8') . "</td><td><pre>
            <span class='badge bg-success'>Active</span>
            </td></tr>";
        }
    }
} else {
    echo "Feeder OFF";
}
?>