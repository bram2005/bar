<?php
    if (isset($_SESSION['BarService']) && \possystem\modules\BarService\Logic\BarServices::getInstance()->checkIfBarServiceIsClosed($_SESSION['BarService']->id) === FALSE) {
        $_SESSION['Error'] = "Bardienst dient nog gesloten te worden";
        echo "<script>window.location.href='/';</script>";
//        header("refresh:0;url=/");
        die();
    }
    session_destroy();
echo "<script>window.location.href='/login.php';</script>";
//    header("refresh:0;url=/login.php");
    die();
?>
