<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['session']) || empty($_SESSION['session'])) {
    http_response_code(403);
    die("Akses ditolak");
}

include "component/config.php";

$module = isset($_POST['module']) ? $_POST['module'] : 'no';
$table  = isset($_POST['table'])  ? $_POST['table']  : 'no';

if ($module !== "no" && $table !== "no") {
    // Validasi format nama tabel hanya karakter alphanumeric dan underscore
    if (preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
        // Cek bahwa tabel benar-benar ada di database saat ini
        $stmt = mysqli_prepare($db, "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $table);
            mysqli_stmt_execute($stmt);
            $checkRes = mysqli_stmt_get_result($stmt);

            if ($checkRes && mysqli_num_rows($checkRes) > 0) {
                // Tabel valid dan terverifikasi
                $query = "SELECT COUNT(*) as jumlah FROM `" . $table . "`";
                $result = mysqli_query($db, $query);
                if ($result && $x = mysqli_fetch_array($result)) {
                    echo (int)$x['jumlah'];
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
            mysqli_stmt_close($stmt);
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
?>