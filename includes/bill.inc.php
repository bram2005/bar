<?php
$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->getByID($_GET['receiptID']);
$receipt = $receipt['result'];
$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptIDMerged($receipt->id);
$fmt = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY);
$totalCount = 0.00;
$tip = 0.00;
$paid = FALSE;
if(!empty($receipt->tip)) {
    $paid = TRUE;
    $tip = $receipt->tip;
} elseif(!empty($_POST['tip'])) {
    $tip = str_replace(',', '.', $_POST['tip']);
} else {
    $tip = FALSE;
} ?>

<div class="row">
    <div class="col-xl-6 col-md-12">
        <?php if($tip === FALSE) { ?>
            <div class="content-box">
                <span class="content-box-title">Fooi</span>
                <form method="post">
                    <span class="content-box-subtitle">Vul hier de fooi in die de klant wil geven.</span><br/><br/>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="name">€</span>
                        <input type="text" class="form-control" id="tip" name="tip" value="0.00" aria-describedby="name">
                    </div>
                    <input type="submit" name="sumbit" class="btn btn-success" value="Fooi toevoegen"/>
                </form>
            </div>
        <?php } else { ?>
            <div class="content-box">
                <span class="content-box-title">Bonnetje <?= $receipt->name ?></span>
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
                    $total = $totalCount + $tip;
                    ?>
                    <tr class="receipt-total">
                        <td class="text-end">Totaal producten</td>
                        <td>€</td>
                        <td class="text-end"><?= substr($fmt->format($totalCount),3) ?></td>
                    </tr>
                    <tr>
                        <td class="text-end">Fooi</td>
                        <td>€</td>
                        <td class="text-end"><?= substr($fmt->format($tip),3) ?></td>
                    </tr>
                    <tr class="receipt-total">
                        <td class="text-end">Totaal</td>
                        <td>€</td>
                        <td class="text-end"><?= substr($fmt->format($total),3) ?></td>
                    </tr>
                    <?php
                    if($paid !== TRUE) {
                        \possystem\modules\Receipts\Logic\Receipts::getInstance()->paid($receipt->id, $total, $tip);
                    }
                    ?>
                </table>
            </div>
        <?php } ?>
    </div>
</div>
