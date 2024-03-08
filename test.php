<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include 'classes/db.php';
require_once 'functions.php';
require_once 'autoloader.php';

printr(\possystem\modules\BarService\Logic\BarServices::getInstance()->getBarServiceByMonthAndUser(14, "June"));

die();
$user = '';
//$user = \possystem\modules\Users\Logic\Users::getInstance()->add('Admin', 'admin', 'admin', 99);
//$user = \possystem\modules\Users\Logic\Users::getInstance()->changePassword(1, 'test1234');
//$user = \possystem\modules\Users\Logic\Users::getInstance()->changeName(8, 'TESTIE55');
//$user = \possystem\modules\Users\Logic\Users::getInstance()->getByID(8);
//$user = \possystem\modules\Users\Logic\Users::getInstance()->remove(13);
//$user = \possystem\modules\Users\Logic\Users::getInstance()->getAll();
//$user = \possystem\modules\Users\Logic\Users::getInstance()->login('admin', 'admin');
//$user = \possystem\modules\Users\Logic\Users::getInstance()->checkPermissionLevel(13, 99);
vardump($user);

$barService = '';
//$barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->add(1);
//$barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->getByID(3);
//$barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->addComment(3, "God wat veel toevoegingen allemaal");
$barService = \possystem\modules\BarService\Logic\BarServices::getInstance()->end(27);
printr($barService);

$category = '';
//$category = \possystem\modules\Categories\Logic\Categories::getInstance()->add('Non-Alcoholisch', 'De non-alcoholische dranken');
//$category = \possystem\modules\Categories\Logic\Categories::getInstance()->remove(3);
//$category = \possystem\modules\Categories\Logic\Categories::getInstance()->getByID(2);
//$category = \possystem\modules\Categories\Logic\Categories::getInstance()->getAll();
//$category = \possystem\modules\Categories\Logic\Categories::getInstance()->change(2,"Non-Alcoholisch", "De non-alcoholische dranken");
printr($category);

$product = '';
//$product = \possystem\modules\Products\Logic\Products::getInstance()->add('Coca Cola Zero', 1.25, 2, 'TEST');
//$product = \possystem\modules\Products\Logic\Products::getInstance()->remove(13);
//$product = \possystem\modules\Products\Logic\Products::getInstance()->getByID(14);
//$product = \possystem\modules\Products\Logic\Products::getInstance()->getAll();
//$product = \possystem\modules\Products\Logic\Products::getInstance()->change(14, 'Coca Cola', 1.75, 2, 'TEST');
printr($product);

$receipt = '';
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->add('Brammetje', 1, 3);
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->remove(4);
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->getByID(2);
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->getAll();
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->paid(22, 10.20, 0.50);
//$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->changeName(2, 'Bram');
printr($receipt);

$payments = '';
//$payments = \possystem\modules\Payments\Logic\Payments::getInstance()->add(2,20.45, 9.81);
printr($payments);

$receiptLines = '';
//$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->add(7,14,4);
//$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->remove(2);
//$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->removeByReceiptID(2);
//$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptID(2);
//$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptIDMerged(7);
printr($receiptLines);