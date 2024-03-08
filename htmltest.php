<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
//include 'classes/db.php';
require_once 'functions.php';
if(isset($_POST['submit'])){
    printr($_FILES);
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $explode = explode('.',$file_name);
    $file_ext=strtolower(end($explode));

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"uploads/products/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $config->title ?></title>
        <link href='assets/css/style.css' rel="stylesheet">

        <!-- BOOTSTRAP -->
        <link href='assets/css/bootstrap.min.css' rel="stylesheet">

        <!-- FONT-AWESOME -->
        <link href='assets/css/all.css' rel="stylesheet">

        <!-- CHARTS -->
        <script src="/assets/js/chart.min.js"></script>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="image" />
            </div>
            <input type="submit"  name="submit" value="Verzenden">
        </form>

    </body>
</html>