<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once 'component/config.php';
set_time_limit(0);
  if(isset($_SESSION['session'])){$session=$_SESSION['session'];}else{$session=0;}
  if ($session==0) {
                          echo "<script type='text/javascript'>
                            alert('Maaf Anda tidak mempunyai hak akses untuk melihat halaman ini!');
                            window.location= 'login.php';
                            </script>";
                          // header('location:../');
                        }
        ?>

    <?php 
include "layout/header.php";   
include "layout/content.php";             
include "layout/footer.php"; ?>
            
        </div>
    </div>

<!-- <script src="assets/vendors/apexcharts/apexcharts.js"></script> -->
<!-- <script src="assets/js/pages/dashboard.js"></script> -->

<script src="assets/js/pages/horizontal-layout.js"></script>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
    <?php include "layout/js.php"; ?>


</body>


</html>
