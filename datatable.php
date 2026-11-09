<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['session']) || empty($_SESSION['session'])) {
    http_response_code(403);
    die(json_encode(["error" => "Akses ditolak"]));
}

include "component/config.php";

$module = isset($_GET['module']) ? $_GET['module'] : 'no';

// Whitelist nama module yang valid untuk data table
$allowed_modules = [
    'feedakm',
    'feedkelaskuliah',
    'feedmhs',
    'feedmk',
    'feedmkk',
    'feednilai',
    'feedpengajar',
    'feedpeserta',
    'getallpt'
];

if (in_array($module, $allowed_modules, true)) {
    $target = __DIR__ . '/loaddata/data_' . $module . '.php';
    if (file_exists($target)) {
        include $target;
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Data handler tidak ditemukan"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Modul tidak valid"]);
}
?>