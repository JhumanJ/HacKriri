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


if(isLogged() && user()->isAdmin() && isset($_POST["_method"]) && isCSRFSafe()){

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

    else if($_POST["_method"]=="admin"){
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
    else if($_POST["_method"]=="snippet"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));

            if ($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t change an admin\'s permission!');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            } else {
                $userManager->toggleSnippet($user);
                $message = new Alert('success', true);
                $message->addText('<strong>Done</strong>! '.$user->getUserName().'\'s permission has been changed.');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            }
        }
    }
    else if($_POST["_method"]=="modify"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));
            if ($user->getId()==user()->getId()){
                header('Location: profile.php');
                exit();
            } else if ($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t change an admin\'s profile!');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            } else {
                createPage('admin.user.modify');
            }
        }
    }else if($_POST["_method"]=="update"){
        //check that id is set
        if(isset($_POST["_id"])){
            $user = $userManager->find((int)htmlspecialchars($_POST["_id"]));
            if ($user->getId()==user()->getId()){
                header('Location: profile.php');
                exit();
            } else if ($user->isAdmin()){
                $message = new Alert('danger', true);
                $message->addText('<strong>Whoops</strong>! You can\'t change an admin\'s profile!');
                $message->messageToSession();
                header('Location: admin.php');
                exit();
            } else {

                if(isset($_POST["imgURL"]) && $_POST["imgURL"]!=""){
                    $user->setImgURL(htmlspecialchars($_POST["imgURL"]));
                }
                if(isset($_POST["profileColour"])&& $_POST["profileColour"]!=""){
                    $user->setProfileColour(htmlspecialchars($_POST["profileColour"]));
                }
                if(isset($_POST["homePageURL"])&& $_POST["homePageURL"]!=""){
                    $user->setHomePageURL(htmlspecialchars($_POST["homePageURL"]));
                }
                if(isset($_POST["description"])&& $_POST["description"]!=""){
                    $user->setDescription(htmlspecialchars($_POST["description"]));
                }
                $userManager->save($user);
                $message = new Alert('success', true);
                $message->addText('<strong>Done</strong>! '.$user->getUserName().'\'s profile has been updated.');
                $message->messageToSession();
                header('Location: admin.php');
                exit();

            }
        }
    } else {
        $message = new Alert('danger', true);
        $message->addText('<strong>Whoops</strong>! User id is missing.');
        $message->messageToSession();
        header('Location: admin.php');
        exit();
    }

} else {

    $message = new Alert('danger', true);
    $message->addText('<strong>Whoops</strong>! You can\'t be there.');
    $message->messageToSession();
    header('Location: index.php');
    exit();

}