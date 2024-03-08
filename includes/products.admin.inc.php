<?php
$products = \possystem\modules\Products\Logic\Products::getInstance()->getAll();

?>
<div class="top-bar">
    <a class="no-link" href="?page=Admin/Product&type=new">
        <button class="addReceipt" data-bs-toggle="modal" data-bs-target="#addReceipt">
            <i class="fa-solid fa-plus-large"></i>
        </button>
    </a>
</div>
<div class="col-xl-12 col-md-12">
    <div class="row">
        <?php foreach($products['result'] as $product) { ?>
            <div class="col-xl-4">
                <a class="no-link" href="?page=Admin/Product&productID=<?=$product->id?>&type=view">
                    <div class="content-box" style="min-height: 170px;">
                        <?php
                        $pos = strpos($product->image, ".");
                        if($pos !== false) { ?>
                            <img class="product-image" style="width:<?= $product->image_width ?>%" src="uploads/products/<?= $product->image ?>">
                        <?php } ?>
                        <span class="content-box-title"><?= $product->name ?></span>
                        <span class="content-box-subtitle">€ <?= $product->price ?></span>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
