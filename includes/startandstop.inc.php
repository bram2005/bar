<?php
if(isset($_POST['start'])) {
    $barServiceID = \possystem\modules\BarService\Logic\BarServices::getInstance()->add($_SESSION['User']->id);
    if ($_SESSION['User']->percentage > 1) {
        $percentage = $_SESSION['User']->percentage*100;
        \possystem\modules\BarService\Logic\BarServices::getInstance()->addComment($barServiceID['result'], "Een percentage van $percentage %");
    }
    $barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->getByID($barServiceID['result']);
    $receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->add("Losse bestellingen", $_SESSION['User']->id,$barService['result']->id);
    $_SESSION['BarService'] = $barService['result'];
}elseif(isset($_POST['stop']) && isset($_SESSION['BarService'])) {
    if (\possystem\modules\Receipts\Logic\Receipts::getInstance()->checkIfOpenRecieptsByBarService($_SESSION['BarService']->id) === FALSE) {
        $_SESSION['Error'] = "De bonnen zijn nog niet afgesloten";
        echo "<script>window.location.href='?page=Home';</script>";
//        header("Refresh:0;url=?page=Home");
        die();
    }
    $barservice = \possystem\modules\BarService\Logic\BarServices::getInstance()->end($_SESSION['BarService']->id);
    $barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->getByID($_SESSION['BarService']->id);
    if(empty($barService['result'])) {
        unset($_SESSION['BarService']);
    } else {
        $_SESSION['BarService'] = $barService['result'];
    }

}
echo "<script>window.location.href='?page=Home';</script>";
//header("Refresh:0;url=?page=Home");
die();
?>