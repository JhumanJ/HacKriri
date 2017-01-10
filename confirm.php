<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 01/02/16
 * Time: 14:25
 */

require("header.php");

//http://www.unisales.co.uk/index?a=1&b=2&c=3


if(isLogged()){
    // ------------ User is already logged -------------

    //it means that user is already confirmed
    header('Location: index.php');
    exit();

} elseif(isset($_GET['confirm'])) {
    //visitor goes on what seems to be a good link

    $message = new Alert("danger",true);

    $confirmCode = htmlspecialchars($_GET['confirm']);

    $userManager = new UserManager($db);
    $user = $userManager->getUniqueFromConfirmCode($confirmCode);

    if ($user instanceof User) {
        //if code corresponds to user
        //echo $user->getUserStatus();

        if ($user->getUserStatus()<2) {
            //if user is not confirmed yet

            //echo ' in';
            //echo $user->getUserStatus();
            $user->setUserStatus(2);
            //echo 'in';
            $userManager->save($user);
            //echo $user->getUserStatus().'in';

            $message = new Alert("info",true);
            $message->addText('Thanks '.$user->getFirstName().'!</br>Your email is now confirmed. You can already login.');
            $message->messageToSession();

            //echo $user->getUserStatus().'should be there';

            header('Location: index.php');
            exit();

            //echo '</br> shouldnt be there';

        } else {
            //user already confirmed
            $message->addText("Your account is already confirmed.");
        }
    } else {
        //confirmCode doesnt exist
        $message->addText("Your comfirm link is broken.");
    }

    $message->messageToSession();
    header('Location: index.php');
    exit();

} else {
    //visitor goes on a wrong link
    $message = new Alert("danger",true);
    $message->addText("Your comfirm link is broken.");
    header('Location: index.php');
    exit();
}



