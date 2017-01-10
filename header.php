<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:45
 */

//This is the php header of all pages
//It includes functions, and useful things like session

//Autoload every class needed
function my_autoload($class_name) {
    if (is_file('lib/' . $class_name . '.php')) {
        require_once 'lib/' . $class_name . '.php';
    } else if (is_file('manager/' . $class_name . '.php')) {
        require_once 'manager/' . $class_name . '.php';
    }
}

spl_autoload_register("my_autoload");

//Session call
session_start();

//Make inludes and add html headers, modules...
function createPage($pageName) {
    //Include Header & navbar
    include("views/modules/module.header.php");
    include("views/modules/module.navbar.php");

    include('views/view.'.$pageName.'.php');

    //include footer
    include("views/modules/module.footer.php");
}

function isLogged() {
    if(isset($_SESSION['user'])&&!empty($_SESSION['user'])&&$_SESSION['user'] instanceof User) {
        return true;
    } else {
        return false;
    }
}

$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

