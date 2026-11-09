<?php

if (isset($_GET['module'])) {
    $module = $_GET['module'];
} else {
    $module = "default";
}

if (isset($_GET["exec"])) {
    $exec = $_GET["exec"];
} else {
    $exec = "-";
}

// Gunakan Prepared Statement untuk mencegah SQL Injection
$stmt = mysqli_prepare($db, "SELECT * FROM sys_modul WHERE module = ? AND exec = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $module, $exec);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ModuleName = $row["nama"];
            $targetUrl = $row["url"];

            // Validasi file target untuk mencegah traversal atau pemanggilan file tidak valid
            if (!empty($targetUrl) && file_exists($targetUrl)) {
                include $targetUrl;
            } else {
                echo "<div class='alert alert-danger m-3'>File modul tidak ditemukan: " . htmlspecialchars($targetUrl, ENT_QUOTES, 'UTF-8') . "</div>";
            }
        }
    } else if ($module === 'cekAKM') {
        $ModuleName = "CEK Aktifitas Kuliah Mahasiswa";
        include "content/tool/cekAKM.php";
    } else {
        echo "<div class='alert alert-warning m-3'>Modul tidak ditemukan atau Anda tidak memiliki akses.</div>";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "<div class='alert alert-danger m-3'>Terjadi kesalahan pada sistem database.</div>";
}
?>