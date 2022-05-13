<?php 
if(file_exists('component/config.php')){
include_once 'component/config.php'; }
else {
    echo "File Config Belum ada, Silahkan Lihat Dokumentasi di <a href='https://github.com/masbudikusuma/neo-integrator'>GITHUB</a>";
    $system_desc = "Neo_integrator";
    $userfeeder=="";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo $system_desc; ?> </title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <!-- <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a> -->
            </div>
            <h1 class="auth-title"><?php echo $system_desc; ?></h1>
            <p class="auth-subtitle mb-5">Integrasikan NEO-Feedermu dengan Aplikasimu</p>

            
            <div class="text-center mt-5 text-lg fs-4">
                
                <?php 
                if ($userfeeder==""){
                    echo "anda belum melakukan pengaturan di config.php";
                    echo '<p class="text-gray-600"><a href="https://github.com/masbudikusuma/neo-integrator" class="font-bold">Lihat Dokumentasi</a>.</p>';
                    echo '<p class="text-gray-600"><a href="https://t.me/+0VWcv9E-Kc82NjNl" class="font-bold">Group Telegram</a>.</p>';
                }else {
                    echo '
                    <form action="authcek.php" method="post">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="username" class="form-control form-control-xl" placeholder="Username PDDIKTI">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password PDDIKTI">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>
                    ';
                }
                ?>
                <!-- <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p> -->
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

    </div>
</body>

</html>
