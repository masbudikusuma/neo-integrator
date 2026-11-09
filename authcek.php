<?php
include_once "component/config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && (!isset($_GET['act']) || empty($_GET['act']))) {
    $ip_address = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $myusername = isset($_POST['username']) ? trim($_POST['username']) : '';
    $rawpassword = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($myusername) || empty($rawpassword)) {
        echo "<script type='text/javascript'>
        alert('Username dan Password tidak boleh kosong!');
        window.location= 'login.php';
        </script>";
        exit;
    }

    $is_feeder_user = (!empty($userfeeder) && $myusername === $userfeeder);
    $feeder_pass_valid = false;
    if ($is_feeder_user) {
        if ($rawpassword === $passfeeder || md5($rawpassword) === $passfeeder || md5($rawpassword) === md5($passfeeder)) {
            $feeder_pass_valid = true;
        }
    }

    if ($is_feeder_user && $feeder_pass_valid) {
        getPT($pt);
        $_SESSION['nama_pt'] = isset($pt['nama_pt']) ? $pt['nama_pt'] : 'Operator PT';
        $_SESSION['id_pt'] = isset($pt['id_pt']) ? $pt['id_pt'] : '';
        $_SESSION['kode_pt'] = $myusername;
        $_SESSION['username'] = $myusername;
        $_SESSION['akses'] = "Operator PT";
        $_SESSION['useridlogin'] = "Operator PT";
        $_SESSION['Nama'] = $nama = "Operator PT";

        // Generate session token yang aman
        $session = bin2hex(random_bytes(32));

        $del_stmt = mysqli_prepare($db, "DELETE FROM sys_session WHERE username = ?");
        if ($del_stmt) {
            mysqli_stmt_bind_param($del_stmt, "s", $myusername);
            mysqli_stmt_execute($del_stmt);
            mysqli_stmt_close($del_stmt);
        }

        $save_stmt = mysqli_prepare($db, "INSERT INTO sys_session (username, session, akses, Nama, ip_address, agent) VALUES (?, ?, '5', ?, ?, ?)");
        if ($save_stmt) {
            mysqli_stmt_bind_param($save_stmt, "sssss", $myusername, $session, $nama, $ip_address, $user_agent);
            mysqli_stmt_execute($save_stmt);
            mysqli_stmt_close($save_stmt);
        }

        $_SESSION['session'] = $session;
        sys_log('berhasil login sebagai Operator PT');
        header("Location: index.php");
        exit;
    }

    // Cek Login Menggunakan Tabel Database sys_user dengan Prepared Statement
    $user_stmt = mysqli_prepare($db, "SELECT * FROM sys_user WHERE username = ?");
    if ($user_stmt) {
        mysqli_stmt_bind_param($user_stmt, "s", $myusername);
        mysqli_stmt_execute($user_stmt);
        $result = mysqli_stmt_get_result($user_stmt);

        if ($result && $login = $result->fetch_assoc()) {
            $db_pass = $login['password'];
            $authenticated = false;

            // 1. Cek modern password hash
            if (password_verify($rawpassword, $db_pass)) {
                $authenticated = true;
            } elseif ($db_pass === md5($rawpassword) || $db_pass === $rawpassword) {
                // 2. Legacy fallback (md5 atau plaintext) -> verifikasi dan upgrade hash otomatis
                $authenticated = true;
                $new_hash = password_hash($rawpassword, PASSWORD_DEFAULT);
                $up_stmt = mysqli_prepare($db, "UPDATE sys_user SET password = ? WHERE id = ?");
                if ($up_stmt) {
                    mysqli_stmt_bind_param($up_stmt, "si", $new_hash, $login['id']);
                    mysqli_stmt_execute($up_stmt);
                    mysqli_stmt_close($up_stmt);
                }
            }

            if ($authenticated) {
                $_SESSION['username'] = $myusername;
                $_SESSION['akses'] = $login['akses'];
                $_SESSION['useridlogin'] = $login['username'];
                $_SESSION['Nama'] = $nama = $login['Nama'];

                $session = bin2hex(random_bytes(32));

                $del_stmt = mysqli_prepare($db, "DELETE FROM sys_session WHERE username = ?");
                if ($del_stmt) {
                    mysqli_stmt_bind_param($del_stmt, "s", $myusername);
                    mysqli_stmt_execute($del_stmt);
                    mysqli_stmt_close($del_stmt);
                }

                $save_stmt = mysqli_prepare($db, "INSERT INTO sys_session (username, session, akses, Nama, ip_address, agent) VALUES (?, ?, ?, ?, ?, ?)");
                if ($save_stmt) {
                    mysqli_stmt_bind_param($save_stmt, "ssssss", $myusername, $session, $login['akses'], $nama, $ip_address, $user_agent);
                    mysqli_stmt_execute($save_stmt);
                    mysqli_stmt_close($save_stmt);
                }

                $_SESSION['session'] = $session;
                sys_log('berhasil login');
                header("Location: index.php");
                exit;
            }
        }
        mysqli_stmt_close($user_stmt);
    }

    // Jika sampai di sini, autentikasi gagal
    sys_log('GAGAL LOGIN USER : ' . $myusername . ' dari IP ' . $ip_address);
    echo "<script type='text/javascript'>
    alert('Maaf Username atau Password anda Salah');
    window.location= 'login.php';
    </script>";
    exit;
}

// Handler Registrasi (jika digunakan)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['act']) && $_GET['act'] === "register") {
    if (isset($_POST['input_kode'])) {
        if (!isset($_SESSION['kode_captcha']) || $_SESSION['kode_captcha'] != $_POST['input_kode']) {
            echo "<script type='text/javascript'>
                   alert('Maaf Code captcha yang anda masukan salah!');
                   window.location= 'register.php';
                   </script>";
            session_destroy();
            exit;
        }

        $email = trim($_POST['email']);
        $nama = trim($_POST['nama']);
        $no_wa = trim($_POST['no_wa']);
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        if ($password1 === $password2) {
            $stmt = mysqli_prepare($db, "SELECT email FROM wabot_user WHERE email = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                if ($res && mysqli_num_rows($res) > 0) {
                    echo "<script type='text/javascript'>
                          alert('Maaf Email $email Sudah Terdaftar');
                          window.location= 'register.php';
                          </script>";
                    session_destroy();
                    exit;
                }
                mysqli_stmt_close($stmt);
            }

            $stmt_wa = mysqli_prepare($db, "SELECT no_wa FROM wabot_user WHERE no_wa = ?");
            if ($stmt_wa) {
                mysqli_stmt_bind_param($stmt_wa, "s", $no_wa);
                mysqli_stmt_execute($stmt_wa);
                $res_wa = mysqli_stmt_get_result($stmt_wa);
                if ($res_wa && mysqli_num_rows($res_wa) > 0) {
                    echo "<script type='text/javascript'>
                          alert('Maaf No $no_wa Sudah Terdaftar');
                          window.location= 'register.php';
                          </script>";
                    session_destroy();
                    exit;
                }
                mysqli_stmt_close($stmt_wa);
            }

            // Simpan password dengan password_hash()
            $password_hash = password_hash($password1, PASSWORD_DEFAULT);
            $stmt_ins = mysqli_prepare($db, "INSERT INTO wabot_user (username, password, name, email, no_wa, akses) VALUES (?, ?, ?, ?, ?, '5')");
            if ($stmt_ins) {
                mysqli_stmt_bind_param($stmt_ins, "sssss", $email, $password_hash, $nama, $email, $no_wa);
                mysqli_stmt_execute($stmt_ins);
                mysqli_stmt_close($stmt_ins);
                echo "<script type='text/javascript'>
                      alert('Registrasi Berhasil, Silahkan Login');
                      window.location= 'login.php';
                      </script>";
                session_destroy();
                exit;
            }
        } else {
            echo "<script type='text/javascript'>
                  alert('Password yang dimasukan Tidak sama');
                  window.location= 'register.php';
                  </script>";
            exit;
        }
    }
}

// Default redirect jika diakses langsung tanpa POST
header("Location: index.php");
exit;
?>