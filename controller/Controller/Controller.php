<?php

namespace possystem\controller\Controller;

class Controller
{
    public function __construct()
    {
    }

    public function CheckIfLoggedIn() : bool
    {
        global $_SESSION;
        global $_GET;
        if(isset($_SESSION['IsLoggedInOnPosSystem']) && $_SESSION['IsLoggedInOnPosSystem'] === TRUE) {
            return TRUE;
        }
        echo "<script>window.location.href='/login.php';</script>";
//        header("refresh:0;url=/login.php");
        die();

    }
}