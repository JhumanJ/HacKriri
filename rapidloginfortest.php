<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/17
 * Time: 19:42
 */

require("header.php");

$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

if (isset($_GET["id"])){
    $userManager = new UserManager($db);
    $user = $userManager->find($_GET["id"]);
    $_SESSION['user'] = $user;

    header("Location: index.php");
    exit();
}