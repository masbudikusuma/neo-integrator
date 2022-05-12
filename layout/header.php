<?php 
if(isset($_SESSION['nama_pt'])){$nama_pt=$_SESSION['nama_pt'];}else{$nama_pt=null;}
if(isset($_SESSION['kode_pt'])){$kode_pt=$_SESSION['kode_pt'];}else{$kode_pt=null;}

if (isset($_GET['module'])){$module = $_GET['module'];}else {$module = "default";}
$sql = "SELECT * from sys_modul where module = '$module'";
$result = mysqli_query($db,$sql) or die(mysqli_error($db));
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
            $module = $row['module'];
            $title = $row['nama']." - NEO HELPER";
	}
} else {
    $title = "NEO-HELPER";
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="assets/vendors/iconly/bold.css"> -->
    <!-- <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">  -->
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script src="assets/js/jquery-3.5.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    
    <!-- <link rel="stylesheet" href="assets/vendors/jquery-datatables/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<body>
    
  
  
  <div id="app">
        <div id="main" class="layout-horizontal">
            

<header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.php">
                                <!-- <img src="assets/images/logo/logo.png" alt="Logo" srcset=""> -->
                            <h3>NEO-Integrator</h3></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?php echo $nama_pt;?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?php echo $kode_pt; ?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="#">My Account</a></li>
                                  <li><a class="dropdown-item" href="#">Settings</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>                                                     
                            <li
                                class="menu-item  ">
                                <a href="index.php" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>                        
                                                        
                            <li
                                class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-collection-fill"></i>
                                    <span>Data FEEDER </span>
                                </a>
                                <div
                                    class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">                                        
                                        <ul class="submenu-group">

                        <?php 
                        $query = "SELECT * from sys_menu where aktif = '1' and id_parent1 = '40' order by id ASC";
                        $hasil = mysqli_query($db, $query);
                        if(mysqli_num_rows($hasil) > 0 ){
                        while($x = mysqli_fetch_array($hasil)){
                            $url = $x["url"]; $nama = $x["nama"];
                        echo "<li class='submenu-item'>
                        <a href='".$url."' class='submenu-link'>".$nama."</a></li>";    
                        }
                    }
                        ?>
                                                                                                                        
                                            
                                        </ul>                                        
                                    </div>
                                </div>
                            </li>
            
                            <!-- ================================================== -->
                            <li
                                class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-cloud-arrow-up-fill"></i>
                                    <span>Import Data </span>
                                </a>
                                <div
                                    class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">                                        
                                        <ul class="submenu-group">
                                        <?php 
                        $query = "SELECT * from sys_menu where aktif = '1' and id_parent1 = '50' order by id ASC";
                        $hasil = mysqli_query($db, $query);
                        if(mysqli_num_rows($hasil) > 0 ){
                        while($x = mysqli_fetch_array($hasil)){
                            $url = $x["url"]; $nama = $x["nama"];
                        echo "<li class='submenu-item'>
                        <a href='".$url."' class='submenu-link'>".$nama."</a></li>";    
                        }
                    }
                        ?>    
                                        
                                        </ul>                                        
                                    </div>
                                </div>
                            </li>
                            <!-- ================================================================================ -->
                            <!-- ================================================== -->
                            <li
                                class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-life-preserver"></i>
                                    <span>Tool </span>
                                </a>
                                <div
                                    class="submenu ">
                                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                    <div class="submenu-group-wrapper">                                        
                                        <ul class="submenu-group">
                                        <?php 
                        $query = "SELECT * from sys_menu where aktif = '1' and id_parent1 = '60' order by id ASC";
                        $hasil = mysqli_query($db, $query);
                        if(mysqli_num_rows($hasil) > 0 ){
                        while($x = mysqli_fetch_array($hasil)){
                            $url = $x["url"]; $nama = $x["nama"];
                        echo "<li class='submenu-item'>
                        <a href='".$url."' class='submenu-link'>".$nama."</a></li>";    
                        }
                    }
                        ?>    
                                        
                                        </ul>                                        
                                    </div>
                                </div>
                            </li>

                            <!-- ============================================= -->

                            
                            
                            <li
                                class="menu-item ">
                                <a href="index.php?module=logprogress" class='menu-link'>
                                    <i class="bi bi-stack"></i>
                                    <span>LOG </span>
                                </a>
                            </li>
                            <li
                                class="menu-item ">
                                <a href="<?php echo $urlfeeder;?>" target="_blank" class='menu-link'>
                                    <i class="bi bi-pen-fill"></i>
                                    <span>NEO-FEEDER </span>
                                </a>
                            </li>
                            <!-- ============================================= -->
                            
                        </ul>
                    </div>
                </nav>

            </header>