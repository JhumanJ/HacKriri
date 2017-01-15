<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 16:54
 */

require("header.php");
$dbFactory = new DBFactory();
$db = $dbFactory->getMysqlConnexionWithPDO();

//If user is logged, show the logged home page
//Otherwise show the visitor home page

if(isLogged()){
    //-----------------User is already logged-------------------
    header("Location: index.php");

} elseif (isset($_POST["register"])&&$_POST["register"]=="111") {
    //----------------Receive form and check it--------------
    $postIsCorrect = true;

    //Save correct fields to reput them in the form
    $correctFields = array();

    //Create alert
    $message = new Alert("danger",true);

    // Check First Name
    if (strlen($_POST["userName"])>=3) {
        $userName = htmlspecialchars($_POST["userName"]);
        $correctFields['userName']=$userName;
    } else {
        $postIsCorrect = false;
        $message->addText('User name is not long enough (min 3 char.).');
    }


    // Check Password
    if ( strlen($_POST["passWord"])>=3) {
        $passWord = htmlspecialchars($_POST["passWord"]);
    } else {
        $postIsCorrect = false;
        $message->addText('Password is not valid.');
    }

    // Check Password Confirm
    if ( strlen($_POST["passWordConfirm"])>=3) {
        $passWordConfirm = htmlspecialchars($_POST["passWordConfirm"]);
    } else {
        $postIsCorrect = false;
        $message->addText('Password is not valid.');
    }

    //Check that both are equal
    if (isset($passWord)&&isset($passWordConfirm)&&$passWord==$passWordConfirm) {
        $passWord = $md5($passWord);
    } else {
        $postIsCorrect = false;
        $message->addText('Passwords are not the same.');
    }

    //-------If all fields are correct--------
    if ($postIsCorrect) {
        // Check that email doesn't exist yet
        $userManager = new UserManager($db);


        if (!($userManager->getUniqueUserName($userName) instanceof User)) {
            //User doesn't exist yet, and data are checked
            //So we register user (userType 1,userStatus 1,..)

            $data = User::returnDataArrayFromData(1,$userName,$passWord);
            $newUser = new User($data);

            $message = new Alert('info', true);
            $message->addText('Welcome <strong>' . $userName . '</strong>! You can now connect.');
            $message->messageToSession();
            $userManager->save($newUser);
            header('Location: index.php');
            exit();

        } else {
            //User exist already ( email already used)
            $message->addText('User name already registered.');
        }
    }

    //-------All fields are NOT correct OR user already registered --------
    // From here, there was a problem with one of the field or user already registered
    // We show the form again, prefill in with error message

    //Save message to transmit it to page
    $message->messageToSession();

    //Save correct fields to transmit to page
    $_SESSION['correctFields'] = $correctFields;

    createPage("register");

} else {
    //Visitor is on home page
    createPage("register");
}