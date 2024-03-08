<?php

$receipts = possystem\modules\Receipts\Logic\Receipts::getInstance()->getAllByBarService($_GET['barserviceID']);
$receipts = $receipts['result'];

foreach ($receipts as $receipt) {
    $receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptIDMerged($receipt->id);
//    printr($receipt);
    ?>
    <div class="col-md-4">

        <div class="content-box">
            <div class="content-box-title"><?= $receipt->name ?> <?= date("d-m-Y H:i", strtotime($receipt->create_datetime)) ?></div>
            <div class="content-box-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Aantal</th>
                        <th>Product</th>
                        <th>Prijs</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($receiptLines['result'] as $receiptLine) { ?>
                            <tr>
                                <td><?= $receiptLine->amount ?>x</td>
                                <td><?= $receiptLine->name ?></td>
                                <td><?= $receiptLine->total_amount ?></td>
                            </tr>
                        <?php }
                        if ($receipt->tip > 0) { ?>
                            <tr>
                                <td></td>
                                <td>Fooi</td>
                                <td><?= $receipt->tip ?></td>
                            </tr>
                            <?php } ?>
                        <tr style="border-top: 2px solid black;">
                            <td></td>
                            <th>Totaal betaald</th>
                            <th><?= $receipt->total_paid ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!--    echo "Receipt";-->
<!--    printr($receipt);-->
<!--    echo "--------------------------------------------------------------<br/>";-->
<!--    echo "ReceiptLines";-->
<!--    printr($receiptLines);-->
<!--    echo "<br/><br/> ========================================================<br/>";-->
<?php } ?>