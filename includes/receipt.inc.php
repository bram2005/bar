<?php
$receipt = \possystem\modules\Receipts\Logic\Receipts::getInstance()->getByID($_GET['receiptID']);
if(isset($receipt['result']->total_paid)) {
    echo "<script>window.location.href='?page=Bill&receiptID={$receipt['result']->id}';</script>";
//    header("Refresh:0;url=?page=Bill&receiptID={$receipt['result']->id}");
    die();
}
$receiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->getAllByReceiptIDMerged($_GET['receiptID']);
$categories = \possystem\modules\Categories\Logic\Categories::getInstance()->getAll();
//$products = \possystem\modules\Products\Logic\Products::getInstance()->getAll();
$fmt = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY);
$totalCount = 0.00;
//printr($products);
if (isset($_POST['submit'])) {
    if(empty($_POST['cart'])) {
        header("Refresh:0");
        die();
    }
    $_POST['submit'] = "";
    $cart = json_decode($_POST['cart']);
    foreach ($cart as $line) {
        $newReceiptLines = \possystem\modules\ReceiptLines\Logic\ReceiptLines::getInstance()->add($_POST['receiptID'],$line[0],$line[2]);
    }
    echo "<script>window.location.href='?page=Receipts';</script>";
//    header("Refresh:0; url=?page=Receipts");
} else {
?>
<div class="col-xl-8 col-md-12">
    <div class="row">
        <div class="accordion" id="accordionExample">
            <?php foreach ($categories['result'] as $category) { ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-<?=$category->id?>">
                        <button class="accordion-button accordion-button-barsystem collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?=$category->id?>" aria-expanded="false" aria-controls="collapse-<?=$category->id?>">
                            <?= $category->name ?>
                        </button>
                    </h2>
                    <div id="collapse-<?=$category->id?>" class="accordion-collapse collapse" aria-labelledby="heading-<?=$category->id?>" data-bs-parent="#accordion-<?=$category->id?>">
                        <div class="accordion-body">
                            <div class="row">
                                <?php
                                $products = \possystem\modules\Products\Logic\Products::getInstance()->getAllByCategoryID($category->id, $_SESSION['User']->percentage);
                                foreach($products['result'] as $product) { ?>
                                    <div class="col-xl-4">

                                        <div class="content-box text-center" style="min-height: 170px;" onclick="addToCart(<?= $product->id ?>, '<?= $product->name ?>')">
                                            <?php
                                            $pos = strpos($product->image, ".");
                                            if($pos !== false) { ?>
                                                <img class="product-image" style="width:<?= $product->image_width ?>%" src="uploads/products/<?= $product->image ?>">
                                            <?php } ?>
                                            <br/>
                                            <span class="content-box-title fs-4"><?= $product->name ?></span><br/>
                                            <span class="content-box-subtitel fs-5"><?= $fmt->format($product->price) ?></span>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="position-fixed w-25">
        <div class="content-box">
            <span class="content-box-title">Bestelling</span>
            <p id="cartP">
                Nog geen producten
            </p>
            <form method="post">
                <input type="hidden" value="" name="cart" id="cartInput">
                <input type="hidden" value="<?= $receipt['result']->id ?>" name="receiptID" id="receiptID">
                <input type="submit" name="submit" value="toevoegen"/>
            </form>
        </div>
        <div class="content-box">
            <span class="content-box-title">Bon: <?= $receipt['result']->name ?></span><br/>
            <span class="content-box-subtitel"><?= $receipt['result']->create_datetime ?></span>
            <table class="receipt">
                <?php if ($receiptLines['complete'] === FALSE) { ?>
                    <tr><td colspan="3">Nog geen dranken besteld</td></tr>
                <?php } else { ?>
                    <tr>
                        <th>Aantal</th>
                        <th>Product</th>
                        <th></th>
                        <th>Prijs</th>
                        <th></th>
                    </tr>
                <?php }
                foreach ($receiptLines['result'] as $receiptLine) {
                    $totalCount += $receiptLine->total_amount;
                    $receiptLine->total_amount = $fmt->format($receiptLine->total_amount);
                    ?>
                    <tr>
                        <td><?= $receiptLine->amount ?>x</td>
                        <td><?= $receiptLine->name ?></td>
                        <td>€</td>
                        <td class="text-end"><?= substr($receiptLine->total_amount,3) ?></td>
                        <td class="text-end"><a class="no-link" href="?page=RemoveProduct&receiptID=<?=$receipt['result']->id?>&productID=<?=$receiptLine->product_id?>"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                <?php }
    //            $fmt = new NumberFormatter( 'nl_NL', NumberFormatter::DECIMAL_ALWAYS_SHOWN, 2 );
                $totalCount = $fmt->format($totalCount);
                ?>
                <tr class="receipt-total">
                    <td></td>
                    <td class="text-end">Totaal</td>
                    <td>€</td>
                    <td class="text-end"><?= substr($totalCount,3) ?></td>
                </tr>
                <?php
    //            printr($receipt);
    //            printr($receiptLines);
                ?>
            </table>
        </div>
    </div>
</div>
<script>
    let cart = [];
    let amount = 1;
    let globalID;
    let check = true;
    let HTML = "";
    let cartdiv = document.getElementById("cartP");
    let cartInput = document.getElementById("cartInput");
    function addToCart(id, name) {
        globalID = id;
        check = true;
        cart.forEach(checkInArray);
        if (check) {
            let cartLine = [id, name, amount];
            cart.push(cartLine);
        }
        HTML = HTML.concat("<table class='receipt'>");
        cart.forEach(createHTML);
        HTML = HTML.concat("</table>");
        cartdiv.innerHTML = HTML;
        HTML = "";
        cartInput.value = JSON.stringify(cart);
    }
    function checkInArray(item) {
        console.log(item);
        if (item[0] === globalID) {
            item[2]++;
            check = false;
        }
    }

    function createHTML(item) {
        HTML = HTML.concat("<tr><td>"+item[2]+"x</td><td>"+item[1]+"</td></tr>");
    }

    function checkOut() {
        cart = [];
    }

</script>
<?php } ?>
