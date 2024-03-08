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
$controller->CheckIfLoggedIn();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $config->title ?></title>
        <link href='assets/css/style.css' rel="stylesheet">

        <!-- BOOTSTRAP -->
        <link href='assets/css/bootstrap.min.css' rel="stylesheet">

        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css">

        <!-- FONT-AWESOME -->
        <link href='assets/css/all.css' rel="stylesheet">

        <!-- CHARTS -->
        <script src="/assets/js/chart.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row h-100">
                <div class="col-2 menu p-0">
                    <div class="logo-box text-center">
                        <img src="assets/img/logo.png" class="logo"/>
                    </div>
                    <ul class="list-group">
                        <a href="/" class="nav-item">
                            <i class="fa-solid fa-house nav-item-icon"></i>
                            <?= $config->pageTitleHome ?>
                        </a>
                        <?php if(isset($_SESSION['BarService']) && $_SESSION['BarService']->end_datetime === NULL) { ?>
                            <a href="/?page=Receipts" class="nav-item">
                                <i class="fa-solid fa-file-invoice nav-item-icon"></i>
                                <?= $config->pageTitleReceipts ?>
                            </a>
                        <?php } ?>
                        <a href="/?page=Manuals" class="nav-item">
                            <i class="fa-solid fa-circle-info nav-item-icon"></i>
                            <?= $config->pageTitleManual ?>
                        </a>
                        <?php if($_SESSION['User']->permission_group_id >= 99) { ?>
                            <a href="/?page=Admin" class="nav-item">
                                <i class="fa-solid fa-gears nav-item-icon"></i>
                                <?= $config->pageTitleAdmin ?>
                            </a>
<!--                            --><?php //if (isset($_GET['page']) && strpos($_GET['page'], 'Admin') !== false) { ?>
<!--                                <a href="/?page=Admin/Overview" class="nav-item">-->
<!--                                    <i class="fa-solid fa-chart-column nav-item-icon"></i>-->
<!--                                    --><?//= $config->pageTitleAdminOverview ?>
<!--                                </a>-->
<!--                                <a href="/?page=Admin/Barservices" class="nav-item">-->
<!--                                    <i class="fa-solid fa-bell-concierge nav-item-icon"></i>-->
<!--                                    --><?//= $config->pageTitleAdminBarservices ?>
<!--                                </a>-->
<!--                                <a href="/?page=Admin/Products" class="nav-item">-->
<!--                                    <i class="fa-solid fa-beer-mug nav-item-icon"></i>-->
<!--                                    --><?//= $config->pageTitleAdminProducts ?>
<!--                                </a>-->
<!--                                <a href="/?page=Admin/Users" class="nav-item">-->
<!--                                    <i class="fa-solid fa-users nav-item-icon"></i>-->
<!--                                    --><?//= $config->pageTitleAdminUsers ?>
<!--                                </a>-->
<!--                                <a href="/?page=Admin/Notifications" class="nav-item">-->
<!--                                    <i class="fa-solid fa-bell-on nav-item-icon"></i>-->
<!--                                    --><?//= $config->pageTitleAdminNotifications ?>
<!--                                </a>-->
<!--                        --><?php //}
                        }?>
                        <a href="/?page=Logout" class="nav-item">
                            <i class="fa-solid fa-arrow-right-from-bracket nav-item-icon"></i>
                            <?= $config->pageTitleLogout ?>
                        </a>
                    </ul>
                </div>
                <div class="col-10 content">
                    <div class="row pt-4">
                        <?php if (isset($_SESSION['Error'])) { ?>
                        <div class="col-12">
                            <div class="content-box">
                                <p class="content-box-title">Error</p>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $_SESSION['Error'] ?>
                                    </div>
                            </div>
                        </div>
                        <?php
                            unset($_SESSION['Error']);
                        }
                        ?>
                        <?php
                        $page = $_GET['page'] ?? NULL;
                        switch($page) {
                            case "Manuals":
                                include "includes/manuals.inc.php";
                                break;
                            case "Receipts":
                                include "includes/receipts.inc.php";
                                break;
                            case "Receipt":
                                include "includes/receipt.inc.php";
                                break;
                            case "Admin":
                                include "includes/admin.inc.php";
                                break;
                            case "Admin/Overview":
                                include "includes/overview.admin.inc.php";
                                break;
                            case "Admin/Barservices":
                                include "includes/barservices.admin.inc.php";
                                break;
                            case "Admin/Barservice":
                                include "includes/barservice.admin.inc.php";
                                break;
                            case "Admin/Products":
                                include "includes/products.admin.inc.php";
                                break;
                            case "Admin/Product":
                                include "includes/product.admin.inc.php";
                                break;
                            case "Admin/Users":
                                include "includes/users.admin.inc.php";
                                break;
                            case "Admin/Notifications":
                                include "includes/notifications.admin.inc.php";
                                break;
                            case "Admin/Notification":
                                include "includes/notification.admin.inc.php";
                                break;
                            case "Logout":
                                include "includes/logout.inc.php";
                                break;
                            case "Bill":
                                include "includes/bill.inc.php";
                                break;
                            case "Comment":
                                include "includes/comment.inc.php";
                                break;
                            case "StartAndStop":
                                include "includes/startandstop.inc.php";
                                break;
                            case "RemoveProduct":
                                include "includes/removeproduct.inc.php";
                                break;
                            default:
                                include "includes/home.inc.php";
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>



        <!-- BOOTSTRAP -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>

        <!-- FONT-AWESOME -->
        <script src="assets/js/all.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    </body>
</html>