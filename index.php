<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 14/01/16
 * Time: 19:24
 */

require("header.php");

//If user is logged, show the logged home page
//Otherwise show the visitor home page

if(isLogged()){
    // ------------ User is already logged -------------
    createPage("home.logged");

} elseif(isset($_POST["login"])&&$_POST["login"]=="111") {
    //-------------- Login form completed --------------

    $loginCorrect = true;

    //Create alert
    $message = new Alert("danger",true);

    //test two fields
    if (strlen($_POST["email"])>=3) {
        $email = htmlspecialchars($_POST["email"]);
    } else {
        $loginCorrect = false;
        $message->addText('Email is not valid.');
    }

    if ( strlen($_POST["passWord"])>=3) {
        $passWord = htmlspecialchars($_POST["passWord"]);
    } else {
        $loginCorrect = false;
        $message->addText('Password is not valid.');
    }

    //if the field content are correct, we check the user
    if ($loginCorrect) {
        $userManager = new UserManager($db);
        if ($userManager->getUniqueFromEmail($email) instanceof User) {
            $user = $userManager->getUniqueFromEmail($email);
            if ($user->getPassWord()==md5($passWord)){

                //Email exists and password is the good one then check that user email is confirmed.
                if($user->getUserStatus()>=2) {
                    //email is confirmed.
                    $_SESSION['user'] = $user;
                    $message = new Alert('info', true);
                    $message->addText('Hello <strong>' . $user->getFirstName() . '</strong>!');
                    $message->messageToSession();

                    header('Location: index.php');
                    exit();
                } else {
                    $message->addText('Please confirm your email address by clicking the link you received.');
                }
            } else {
                $message->addText('Password invalid.');
            }
        } else {
            $message->addText('Email address doesn\'t correspond to any users.');
        }
    }

    $message->messageToSession();
    createPage("home.visitor");


} else {
    //--------- Visitor is on home page ---------------
    createPage("home.visitor");

}