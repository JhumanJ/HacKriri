<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 10/01/17
 * Time: 14:49
 */

require('lib/DBFactory.php');
require('manager/UserManager.php');
require('manager/SnippetManager.php');
require('lib/Alert.php');
require('lib/Snippet.php');
require('lib/User.php');

require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

if(isLogged() && user()->isAdmin() ){

    $userManager = new UserManager($db);
    createPage("admin");

} else {

    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! You can\'t be there.');
    $message->messageToSession();
    header('Location: index.php');
    exit();
}