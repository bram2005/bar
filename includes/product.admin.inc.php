<?php
if(!empty($_GET['productID'])) {
    $product = \possystem\modules\Products\Logic\Products::getInstance()->getByID($_GET['productID']);
}
if(isset($_POST['submit'])) {
    if ($_GET['type'] === "edit") {
        $oldproduct = \possystem\modules\Products\Logic\Products::getInstance()->getByID($_GET['productID']);
    }
    $errors= array();
    if (!empty($_FILES['productImage']['name'])) {
        $file_name = $_FILES['productImage']['name'];
        $file_size = $_FILES['productImage']['size'];
        $file_tmp = $_FILES['productImage']['tmp_name'];
        $file_type = $_FILES['productImage']['type'];
        $explode = explode('.', $file_name);
        $file_ext = strtolower(end($explode));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be excately 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "uploads/products/" . $file_name);
            echo "Success";
        } else {
            print_r($errors);
        }
    } else {
        $file_name = $oldproduct['result']->image;
    }
    $_POST['price'] = str_replace(',', '.', $_POST['price']);
    if ($_GET['type'] === "edit") {
        $product = \possystem\modules\Products\Logic\Products::getInstance()->change($_GET['productID'], $_POST['name'], $_POST['price'], $_POST['category'],$file_name );
    } elseif ($_GET['type'] === "new") {
        $product = \possystem\modules\Products\Logic\Products::getInstance()->add($_POST['name'], $_POST['price'], $_POST['category'], $file_name);
    }
    echo "<script>window.location.href='?page=Admin/Products';</script>";
//    header("Refresh:0;url=?page=Admin/Products");
    die();
}
$categories = \possystem\modules\Categories\Logic\Categories::getInstance()->getAll();
?>
<div class="col-xl-12 col-md-12">
    <div class="row">
            <div class="col-xl-12">
                <form method="post" enctype="multipart/form-data">
                    <div class="content-box">
                        <span class="content-box-title">Product</span>
                        <?php if($_GET['type'] === "view") { ?>
                            <a class="no-link" href="?page=Admin/Product&productID=<?= $product['result']->id?>&type=edit"><i class="fa-solid fa-pencil"></i></a>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xl-12 mb-3">
                                <div class="form-group">
                                    <label for="name">Naam</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $product['result']->name ?? "" ?>" <?php if($_GET['type'] === "view") { ?>disabled<?php } ?>>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-group">
                                    <label for="price">Prijs</label>
                                    <input type="text" class="form-control" id="price" name="price" value="<?= $product['result']->price ?? "" ?>" <?php if($_GET['type'] === "view") { ?>disabled<?php } ?>>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-3">
                                <div class="form-group">
                                    <label for="price">Categorie</label>
                                    <select class="form-select" id="category" name="category" <?php if($_GET['type'] === "view") { ?>disabled<?php } ?>>
                                        <?php foreach($categories['result'] as $category) { ?>
                                            <option value="<?= $category->id ?>" <?php if(!empty($product['result']->category_id) && $product['result']->category_id === $category->id) { ?>selected<?php } ?>><?= $category->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php if($_GET['type'] !== "view") { ?>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-group">
                                        <label for="productImage">Image</label>
                                        <input class="form-control" type="file" id="productImage" name="productImage">
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Opslaan">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
