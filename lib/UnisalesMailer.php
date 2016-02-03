<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 01/02/16
 * Time: 14:11
 */

class UnisalesMailer extends PHPMailer{

    public function __construct() {

        $this->IsSMTP();
        $this->Host = localhost;
        $this->From = "unisales@unisales.co.uk";
        $this->FromName = "Unisales";
        $this->isHTML(true);

    }

    public function sendEmailVerify(User $user) {

        $this->addAddress($user->getEmail(), $user->getFirstName().' '.$user->getLastName());
        $this->Subject = "Unisales : Thanks for registering";
        $this->Body = '<h4>Hello '.$user->getFirstName().'!</h4></br><p>You successfully registered to Unisales. Before you can login, you need to confim your email addess, by clicking the following link:</br>
        <a href="http://www.unisales.co.uk/confirm?confirm='.$user->getEmailChecker().'">Click here to confirm</a></br>
        </br>You can also copy and paste this link: http://www.unisales.co.uk/confirm?confirm='.$user->getEmailChecker().' </p></br>
        <p>See you soon on Unisales!</p>';
        $this->AltBody = "This is the plain text version of the email content";

        if($this->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}