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
} else if(isLogged()){
    // ------------ User is already logged -------------
    if(isset($_POST["_method"])){
        $userManager = new UserManager($db);
        if($_POST["_method"]=="modify"){
            createPage('profile.modify');
        } else if($_POST["_method"]=="update"){
            $user = $userManager->find(user()->getId());
            if(isset($_POST["userName"]) && $_POST["userName"]!=""){
                $user->setImgURL(htmlspecialchars($_POST["userName"]));
            }
            if(isset($_POST["imgURL"])){
                $user->setImgURL(htmlspecialchars($_POST["imgURL"]));
            }
            if(isset($_POST["profileColour"])){
                $user->setProfileColour(htmlspecialchars($_POST["profileColour"]));
            }
            if(isset($_POST["homePageURL"])){
                $user->setHomePageURL(htmlspecialchars($_POST["homePageURL"]));
            }
            if(isset($_POST["description"])){
                $user->setDescription(htmlspecialchars($_POST["description"]));
            }
            $userManager->save($user);
            $userManager->refreshSession();

            $message = new Alert('success', true);
            $message->addText('<strong>Done</strong>! Your profile has been updated.');
            $message->messageToSession();
            header('Location: profile.php');
            exit();
        }
    } else{
        header('Location: profile.php?id='.user()->getId());
    }
} else{
    //-------------- Visitor not user -------------------
    header("Location: index.php");
    exit();
}