<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 19:24
 */

require("header.php");

$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

//If user is logged, show the logged home page
//Otherwise show the visitor home page

if(isLogged()){
    // ------------ User is already logged -------------
    $snippetManager = new SnippetManager($db);
    $userManager = new UserManager($db);
    $snippets = $snippetManager->userSnippet(user());
    $userLists = $userManager->getAll();
    createPage("home.logged");

} elseif(isset($_GET["login"])&&$_GET["login"]=="111") {
    //-------------- Login form completed --------------

    $loginCorrect = true;

    //Create alert
    $message = new Alert("danger",true);

    //test two fields
    if (strlen($_GET["userName"])>=3) {
        $userName = htmlspecialchars($_GET["userName"]);
    } else {
        $loginCorrect = false;
        $message->addText('User name is not valid.');
    }

    if ( strlen($_GET["passWord"])>=3) {
        $passWord = htmlspecialchars($_GET["passWord"]);
    } else {
        $loginCorrect = false;
        $message->addText('Password is not valid.');
    }

    //if the field content are correct, we check the user
    if ($loginCorrect) {
        $userManager = new UserManager($db);
        if ($userManager->getUniqueUserName($userName) instanceof User) {
            $user = $userManager->getUniqueUserName($userName);
            if ($user->getPassWord()==md5($passWord)){

                //Email exists and password is the good one then check that user email is confirmed.

                $_SESSION['user'] = $user;
                $message = new Alert('info', true);
                $message->addText('Hello <strong>' . $user->getUserName() . '</strong>!');
                $message->messageToSession();

                if(isset($_GET["redirect"])){
                    $redirect = 'Location: '.$_GET["redirect"];
                    header($redirect);
                    exit();
                } else{
                    header('Location: index.php');
                    exit();
                }


            } else {
                $message->addText('Password invalid.');
            }
        } else {
            $message->addText('User name doesn\'t correspond to any users.');
        }
    }

    $message->messageToSession();
    $userManager = new UserManager($db);
    createPage("home.visitor");
    exit();

} else {
    //--------- Visitor is on home page ---------------
    $userManager = new UserManager($db);
    $snippetManager = new SnippetManager($db);
    createPage("home.visitor");
    exit();

}