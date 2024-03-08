<?php

namespace possystem\controller;

class Controller
{
    public function __construct()
    {
    }

    public function CheckIfLoggedIn() : bool
    {
        global $_SESSION;
        return $_SESSION['IsLoggedInOnPosSystem'] === TRUE;
    }
}