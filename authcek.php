<?php
include_once "component/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['act']))
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $myusername = $_POST['username'];
    $mypassword = md5($_POST['password']);
    // Cek Login Menggunakan AKUN FEEDER

    if (($myusername == $userfeeder) && ($mypassword == md5($passfeeder))){
        getPT($pt);
        $_SESSION['nama_pt'] = $pt['nama_pt'];
        $_SESSION['id_pt'] = $pt['id_pt'];
        $_SESSION['kode_pt'] = $myusername;
        $_SESSION['username'] = $myusername;
        $_SESSION['akses'] = "Operator PT";
        $_SESSION['useridlogin'] = "Operator PT";
        $_SESSION['Nama'] = $nama = "Operator PT";
        $hash_session = date("Y/m/d h:i:s") . $myusername;
        $del_sess = "DELETE FROM sys_session WHERE   username='$myusername'";
        mysqli_query($db, $del_sess) ;
            $session = md5(md5(md5(md5(md5($hash_session)))));
            $save_session = "INSERT INTO sys_session ( username, session, akses, Nama, ip_address,agent) VALUES
             ('$myusername', '$session', '5', '$nama','$ip_address','$user_agent');";
            mysqli_query($db, $save_session);
            $_SESSION['session'] = $session;
            sys_log('berhasil login');
            header("location: index.php");

        }else{
        sys_log('GAGAL LOGIN USER : ' . $myusername . ' dari IP ' . $ip_address);
        echo "<script type='text/javascript'>
        alert('Maaf Password anda Salah');
        window.location= 'login.php';
        </script>";
        }

    
    // echo $myusername;
    $sql = "SELECT * FROM sys_user WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    if ($result->num_rows > 0)
    {
            $login = $result->fetch_assoc();
            $_SESSION['username'] = $myusername;
            $_SESSION['akses'] = $login['akses'];
            $_SESSION['useridlogin'] = $login['username'];
            $_SESSION['Nama'] = $nama = $login['Nama'];
            $hash_session = date("Y/m/d h:i:s") . $myusername;
            $del_sess = "DELETE FROM sys_session WHERE   username='$myusername'";
            mysqli_query($db, $del_sess) ;
            $session = md5(md5(md5(md5(md5($hash_session)))));
            $save_session = "INSERT INTO sys_session ( username, session, akses, Nama, ip_address,agent) VALUES
             ('$myusername', '$session', '5', '$nama','$ip_address','$user_agent');";
            mysqli_query($db, $save_session);
            $_SESSION['session'] = $session;
            sys_log('berhasil login');
            header("location: index.php");

    }
    else{
        echo "<script type='text/javascript'>
          alert('Maaf Username dan Password anda Salah');
          window.location= 'login.php';
          </script>";
        sys_log('GAGAL LOGIN USER : ' . $myusername . ' dari IP ' . $ip_address);
        $login['userid']= "";
        $login['name']="";
    }

  

}

// DAFTAR
if (isset($_GET['act'])){
  $_GET['act'] = $_GET['act'];
} else {
  $_GET['act'] = "";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['act'] == "register")
{

    if (isset($_POST['input_kode']))
    {
        if ($_SESSION['kode_captcha'] != $_POST['input_kode'])
        {
            echo "<script type='text/javascript'>
                   alert('Maaf Code captcha yang anda masukan salah!');
                   window.location= 'register.php';
                   </script>";
            session_destroy();
        }
        else
        {
            $email = $_POST['email'];
            $nama = $_POST['nama'];
            $no_wa = $_POST['no_wa'];
            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];

            if ($password1 == $password2)
            { //Cek verifikasi Password
                $sql = "SELECT * FROM wabot_user WHERE email = '$email'";
                $result = mysqli_query($db, $sql);
                if ($result->num_rows > 0)
                {
                    echo "<script type='text/javascript'>
                                  alert('Maaf Email $email Sudah Terdafatar');
                                  window.location= 'register.php';
                                  </script>";
                    session_destroy();
                }
                else
                { //email belum Terdafatar, Cek WA
                    $wa = "SELECT * FROM wabot_user WHERE no_wa = '$no_wa'";
                    $res_wa = mysqli_query($db, $wa);
                    if ($res_wa->num_rows > 0)
                    {
                        echo "<script type='text/javascript'>
                                        alert('Maaf No $no_wa Sudah Terdafatar');
                                        window.location= 'register.php';
                                        </script>";
                        session_destroy();
                    }
                    else
                    { //Simpan Form Registrasi
                        $password = md5($password1);
                        $insert_user = "INSERT INTO wabot_user (username, password, name, email, no_wa, akses)
                                      VALUES ('$email', '$password', '$nama', '$email', '$no_wa', '5');";
                        $res_wa = mysqli_query($db, $insert_user) or die(mysqli_error($db));
                        echo "<script type='text/javascript'>
                                        alert('Registrasi  Berhasil, Silahkan Login untuk mulai membuat Polling');
                                        window.location= 'login.php';
                                        </script>";
                        session_destroy();
                    }
                }

            }
            else
            {
                //else verifikasi password
                echo "<script type='text/javascript'>
                      alert('Password yang dimasukan Tidak sama');
                      window.location= 'register.php';
                      </script>";

            }

        }

    }
}
echo "<script type='text/javascript'>
      window.location= 'index.php';
      </script>";
?>
