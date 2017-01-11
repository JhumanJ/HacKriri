<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 11/01/17
 * Time: 14:04
 */



require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();


if(isLogged() && user()->isAdmin() && isset($_POST["_method"])){

    $userManager = new UserManager($db);

    //Delete user


    if($_POST["_method"]=="delete"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));
            if ($user->getId()==user()->getId()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t delete your own user!');
                $message->messageToSession();
                header('Location: admin.php');
            } else if($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t delete an admin user!');
                $message->messageToSession();
                header('Location: admin.php');
            }
            $userManager->delete($user);
            $message = new Alert('success', true);
            $message->addText('<strong>Done</strong>! '.$user->getUserName().' was deleted.');
            $message->messageToSession();
            header('Location: admin.php');
            exit();
        }
    }

    if($_POST["_method"]=="admin"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));
            if ($user->getId()==user()->getId()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t promote yourself again!');
                $message->messageToSession();
                header('Location: admin.php');
            } else if($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t promote an admin!');
                $message->messageToSession();
                header('Location: admin.php');
            }
            $userManager->promote($user);
            $message = new Alert('success', true);
            $message->addText('<strong>Done</strong>! '.$user->getUserName().' is now an admin.');
            $message->messageToSession();
            header('Location: admin.php');
            exit();
        }
    }
    if($_POST["_method"]=="snippet"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));

            if ($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t change an admin\'s permission!');
                $message->messageToSession();
                header('Location: admin.php');
            } else if($user->canPublish()){
                $userManager->promote($user);
                $message = new Alert('success', true);
                $message->addText('<strong>Done</strong>! '.$user->getUserName().' is now an admin.');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            } else {
                $userManager->promote($user);
                $message = new Alert('success', true);
                $message->addText('<strong>Done</strong>! '.$user->getUserName().' is now an admin.');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            }
        }
    }
    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! User id is missing.');
    $message->messageToSession();
    header('Location: admin.php');

} else {

    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! You can\'t be there.');
    $message->messageToSession();
    header('Location: index.php');
    exit();

}