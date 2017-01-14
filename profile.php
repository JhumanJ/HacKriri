<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 30/01/16
 * Time: 20:39
 */

require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

if(isset($_GET["user"])) {
    if(isset($_GET["user"]) && $_GET["user"]!="") {
        $userManager = new UserManager($db);
        $user = $userManager->getUniqueUserName($_GET["user"]);
        $sessionUser = user();
        $snippetManager= new SnippetManager($db);
        $snippets = $snippetManager->userSnippet($user);
        createPage('profile');
    }else{
        header("Location: index.php");
        exit();
    }
} else if(isLogged()){
    // ------------ User is already logged -------------
    if(isset($_POST["_method"])){
        $userManager = new UserManager($db);
        if($_POST["_method"]=="modify"){
            createPage('profile.modify');
        }
    }else if(isset($_GET["_method"]) && $_GET["_method"]=="update"){
        $userManager = new UserManager($db);
        $user = $userManager->find($_GET["_id"]);
        if(isset($_GET["userName"]) && $_GET["userName"]!=""){
            $user->setImgURL(htmlspecialchars($_GET["userName"]));
        }
        if(isset($_GET["imgURL"]) && $_GET["imgURL"]!=""){
            $user->setImgURL(htmlspecialchars($_GET["imgURL"]));
        }
        if(isset($_GET["profileColour"]) && $_GET["userName"]!=""){
            $user->setProfileColour(htmlspecialchars($_GET["profileColour"]));
        }
        if(isset($_GET["homePageURL"]) && $_GET["homePageURL"]!=""){
            $user->setHomePageURL(htmlspecialchars($_GET["homePageURL"]));
        }
        if(isset($_GET["description"]) && $_GET["description"]!=""){
            $user->setDescription(htmlspecialchars($_GET["description"]));
        }
        $userManager->save($user);
        $userManager->refreshSession();

        $message = new Alert('success', true);
        $message->addText('<strong>Done</strong>! Your profile has been updated.');
        $message->messageToSession();
        header('Location: profile.php');
        exit();
    }else if(isset($_GET["id"])) {
        if(isset($_GET["id"]) && $_GET["id"]!="") {
            $userManager = new UserManager($db);
            $user = user();
            $snippetManager= new SnippetManager($db);
            $snippets = $snippetManager->findByUserId($_GET["id"]);
            createPage('profile');
        }else{
            header("Location: index.php");
            exit();
        }
    } else{
        header('Location: profile.php?id='.user()->getId());
    }
} else{
    //-------------- Visitor not user -------------------
    $message = new Alert('danger', true);
    $message->addText('Error <strong>You can\'t be there!</strong>!');
    $message->messageToSession();
    header("Location: index.php");
    exit();
}