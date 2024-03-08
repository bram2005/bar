<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//include 'classes/db.php';
require_once 'functions.php';
require_once 'autoloader.php';
$config = include 'assets/lang/nl.php';
if(!isset($error)) {
    $error = FALSE;
}
if(!empty($_POST['submit'])) {
    $user = \possystem\modules\Users\Logic\Users::getInstance()->login($_POST['username'], $_POST['password']);
    if($user['complete']) {
        \possystem\modules\BarService\Logic\BarServices::getInstance()->getOpenBarServiceOnUser($user['result']->id);
        echo "<script>window.location.href='/?page=Home';</script>";
//        header("refresh:0;url=/?page=Home");
    } else {
        $error = TRUE;
    }

}
?>

    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?= $config->title ?></title>
            <link href='assets/css/login.css' rel="stylesheet">

            <!-- BOOTSTRAP -->
            <link href='assets/css/bootstrap.min.css' rel="stylesheet">

            <!-- FONT-AWESOME -->
            <link href='assets/css/all.css' rel="stylesheet">
        </head>
        <body>
            <div class="container h-100 d-flex align-items-center">
                <div class="login-box">
<!--                    <i class="fa-solid fa-beer-mug login-logo"></i>-->
                    <img src="assets/img/logo.png" class="login-logo"/>
<!--                    <p class="login-title">--><?//= $config->loginTitle ?><!--</p>-->
                    <?php if($error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $config->loginErrorMessage ?>
                        </div>
                    <?php } ?>
                    <p class="login-title"><?= $config->loginSubTitle ?> <?= $config->loginTitle ?></p>
                    <form method="post">
                        <div class="form-floating">
                            <input type="text" name="username" class="form-control login-input" id="floatingInput" placeholder="<?= $config->loginInputUsername ?>">
                            <label for="floatingInput"><?= $config->loginInputUsername ?></label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control login-input" id="floatingInput" placeholder="<?= $config->loginInputPassword ?>">
                            <label for="floatingInput"><?= $config->loginInputPassword ?></label>
                        </div>
                        <input type="submit" name="submit" class="form-control login-submit" value="<?= $config->loginSubmitBTN ?>">
                    </form>
                </div>
            </div>
        </body>
    </html>