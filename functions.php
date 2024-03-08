<?php

if(!function_exists("printr")){
    function printr() {
        echo "<pre>";
        foreach(func_get_args() as $arg){
            print_r($arg);
        }
        echo "</pre>";
    }
}
if(!function_exists("vardump")){
    function vardump() {
        echo "<pre>";
        call_user_func_array('var_dump',  func_get_args());
        echo "</pre>";
    }
}
