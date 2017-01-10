<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 30/01/16
 * Time: 20:39
 */

require("header.php");


if(isLogged()){
    // ------------ User is already logged -------------
    echo 'test';

} else {
    //-------------- Visitor not user -------------------
    header("Location: index.php");
    exit();
}