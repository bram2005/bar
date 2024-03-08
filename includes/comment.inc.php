<?php
$addComment = \possystem\modules\BarService\Logic\BarServices::getInstance()->addComment($_SESSION['BarService']->id, $_POST['comment']);
$barservice = \possystem\modules\BarService\Logic\BarServices::getInstance()->getByID($_SESSION['BarService']->id);
$_SESSION['BarService'] = $barservice['result'];
echo "<script>window.location.href='?page=Home';</script>";
//header("Refresh:0;url=?page=Home");

