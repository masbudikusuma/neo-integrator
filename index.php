<?php
session_start();
include_once 'component/config.php';
set_time_limit(0);

if (!isset($_SESSION['session']) || empty($_SESSION['session'])) {
    echo "<script type='text/javascript'>
      alert('Maaf Anda tidak mempunyai hak akses untuk melihat halaman ini!');
      window.location= 'login.php';
      </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
include "layout/header.php";   
include "layout/content.php";             
include "layout/footer.php"; ?>
            
        </div>
    </div>

<script src="assets/js/pages/horizontal-layout.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
    <?php include "layout/js.php"; ?>

</body>
</html>
