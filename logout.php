<?php
  session_start();
  include_once 'component/config.php';
  sys_log('Berhasil Logout');
  // session_destroy();

  if (isset($_SESSION['session'])){
    $session = $_SESSION['session'];
    // echo $session;
    $del_sess = "DELETE FROM sys_session WHERE  session='$session'";
    mysqli_query($db,$del_sess) or die(mysqli_error($db));
  }
  session_destroy();
  echo "<script>alert('Anda telah keluar dari halaman dashboard'); window.location = 'login.php'</script>";

?>
