<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//include 'classes/db.php';
require_once 'functions.php';
require_once 'autoloader.php';
$config = include 'assets/lang/nl.php';
$controller = new \possystem\controller\Controller\Controller();
$controller->CheckIfLoggedIn()
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $config->title ?></title>
    <link href='assets/css/style.css' rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href='assets/css/bootstrap.min.css' rel="stylesheet">

    <!-- FONT-AWESOME -->
    <link href='assets/css/all.css' rel="stylesheet">
</head>
<body>
<div class="container h-100 bg-offwhite">
    <header>
        <div class="px-3 py-2">
            <div class="container border-bottom-green">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center title my-2 my-lg-0 me-lg-auto text-decoration-none">
                        <span class="fs-4"><?= $config->title ?></span>
                    </a>
                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                        <?php if ($controller->CheckIfLoggedIn()) { ?>
                            <li>
                                <a href="/" class="nav-link nav-link-active text-center">
                                    <i class="fa-solid fa-house"></i><br/>
                                    <?= $config->pageTitleHome ?>
                                </a>
                            </li>
                            <li>
                                <a href="/?page=Receipts" class="nav-link text-center">
                                    <i class="fa-solid fa-file-invoice"></i><br/>
                                    <?= $config->pageTitleReceipts ?>
                                </a>
                            </li>
                            <li>
                                <a href="/?page=BarService" class="nav-link text-center">
                                    <i class="fa-solid fa-bell-concierge"></i><br/>
                                    <?= $config->pageTitleBarService ?>
                                </a>
                            </li>
                            <li>
                                <a href="/?page=Admin" class="nav-link text-center">
                                    <i class="fa-solid fa-gears"></i><br/>
                                    <?= $config->pageTitleAdmin ?>
                                </a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="/?page=Logout" class="nav-link text-center">
                                <i class="fa-solid fa-right-from-bracket"></i><br/>
                                <?= $config->pageTitleLogout ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="row content-box">
        <div class="col-md-12 content-box-title">
            <?php if (isset($_GET['page'])) { ?>
                <span class="sub-menu-title"><?= $_GET['page'] ?></span>
            <?php }  ?>
        </div>
        <div class="col-12 content-box-content">
            <?php
            $page = $_GET['page'] ?? NULL;
            switch($page) {
                case "BarService":
                    include "includes/barservice.inc.php";
                    break;
                case "Receipts":
                    include "includes/receipts.inc.php";
                    break;
                case "Admin":
                    include "includes/admin.inc.php";
                    break;
                case "Logout":
                    include "includes/logout.inc.php";
                    break;
                default:
                    include "includes/home.inc.php";
                    break;
            }
            ?>
        </div>
    </div>
</div>



<!-- BOOTSTRAP -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- FONT-AWESOME -->
<script src="assets/js/all.js"></script>
</body>
</html>
