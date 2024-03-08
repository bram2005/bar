<?php
if(isset($_GET['remove'])) {
    $removeReceipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->remove($_GET['remove']);
    echo "<script>window.location.href='?page=Receipts';</script>";
//    header("Refresh:0;url=?page=Receipts");

}
if (isset($_POST['submit'])) {
    $createReceipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->add($_POST['name'], $_SESSION['User']->id,$_SESSION['BarService']->id);
    if($createReceipt['complete']) {
        echo "<script>window.location.href='';</script>";
//        header("Refresh:0");
    } else { ?>
        <div class="alert alert-danger" role="alert">
            Helaas is er wat fout gegaan. Probeer opnieuw.
        </div>
    <?php }
}
$receipts = \possystem\modules\Receipts\Logic\Receipts::getInstance()->getAllByBarService($_SESSION['BarService']->id);

?>

<div class="top-bar">
    <button class="addReceipt" data-bs-toggle="modal" data-bs-target="#addReceipt"><i class="fa-solid fa-plus-large"></i></button>
</div>
<!--MODEL ADD RECEIPT-->
<div class="modal fade" id="addReceipt" tabindex="-1" aria-labelledby="addReceiptLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReceiptLabel">Bon toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Naam:</span>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="submit" class="btn btn-success" value="Toevoegen"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!--MODEL CREATE BILL-->
<div class="modal fade" id="addReceipt" tabindex="-1" aria-labelledby="addReceiptLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReceiptLabel">Bon toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">Fooi:</span>
                        <input type="text" class="form-control" id="tip" name="tip" aria-describedby="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="sumbit" class="btn btn-success" value="Toevoegen"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
foreach($receipts['result'] as $receipt) {
    $fmt = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY);
    $totalCount = 0.00;
    $receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptIDMerged($receipt->id);
    $bgColor = "bg-orange";
    if (empty($receipt->total_paid)) {
       $bgColor = "bg-green";
    }
    ?>
    <div class="col-xl-4 col-md-6">
        <a class="no-link" href="?page=Receipt&receiptID=<?=$receipt->id?>">
        <div class="content-box <?= $bgColor ?>">
            <p class="content-box-title"><?= $receipt->name ?></p>
            <p class="content-box-subtitle"><?= date('d-m-Y H:i',strtotime($receipt->create_datetime)) ?></p>
            <table class="receipt">
                <?php if ($receiptLines['complete'] === FALSE) { ?>
                    <tr><td colspan="3">Nog geen dranken besteld</td></tr>
                <?php } else { ?>
                    <tr>
                        <th>Aantal</th>
                        <th colspan="2">Prijs</th>
                    </tr>
                <?php }
                foreach ($receiptLines['result'] as $receiptLine) {
                    $totalCount += $receiptLine->total_amount;
                    $receiptLine->total_amount = $fmt->format($receiptLine->total_amount);
                    ?>
                    <tr>
                        <td><?= $receiptLine->amount ?>x <?= $receiptLine->name ?></td>
                        <td>€</td>
                        <td class="text-end"><?= substr($receiptLine->total_amount,3) ?></td>
                    </tr>
                <?php }
                //            $fmt = new NumberFormatter( 'nl_NL', NumberFormatter::DECIMAL_ALWAYS_SHOWN, 2 );
                $totalCount = $fmt->format($totalCount);
                ?>
                <tr class="receipt-total">
                    <td class="text-end">Totaal</td>
                    <td>€</td>
                    <td class="text-end"><?= substr($totalCount,3) ?></td>
                </tr>
                <?php
                //            printr($receipt);
//                            printr($receiptLines);
                ?>
            </table>
            <?php
            if (empty($receipt->total_paid)) {
                if (empty($receiptLines['result'])) { ?>
                    <a href="?page=Receipts&remove=<?=$receipt->id?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                <?php } ?>
                <a href="?page=Bill&receiptID=<?=$receipt->id?>" class="btn btn-success"><i class="fa-solid fa-money-check-dollar"></i></a>
            <?php } ?>
        </div>
        </a>
    </div>
<?php } ?>
