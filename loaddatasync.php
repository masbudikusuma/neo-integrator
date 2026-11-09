<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['session']) || empty($_SESSION['session'])) {
    http_response_code(403);
    die("Akses ditolak");
}

include "component/config.php";

if (isset($_POST['module']) && isset($_POST['act'])) {
    $module = $_POST['module'];
    $act = $_POST['act'];

    // Sanitasi parameter act untuk mencegah Local File Inclusion (LFI) & directory traversal
    $clean_act = basename($act);
    $clean_act = preg_replace('/[^a-zA-Z0-9_-]/', '', $clean_act);
    $target_file = __DIR__ . '/loaddata/' . $clean_act . '.php';

    if (!empty($clean_act) && file_exists($target_file)) {
        include $target_file;
    } else {
        echo "<div class='alert alert-warning'>Data loader tidak ditemukan.</div>";
    }
}
?>