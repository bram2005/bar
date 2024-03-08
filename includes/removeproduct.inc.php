<?php
if(isset($_GET['receiptID']) && isset($_GET['productID'])) {
    $receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->add($_GET['receiptID'],$_GET['productID'],1, "-");
}
echo "<script>window.location.href='?page=Receipt&receiptID={$_GET['receiptID']}';</script>";
//header("Refresh:0;url=?page=Receipt&receiptID={$_GET['receiptID']}");
die();