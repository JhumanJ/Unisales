<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 01/02/16
 * Time: 10:25
 */


require("header.php");

$mail = new PHPMailer;

$mail->IsSMTP();
$mail->Host       = localhost;
//$mail->SMTPAuth   = true;
//$mail->SMTPSecure = "ssl";
//$mail->Host       = "n1plcpnl0072.prod.ams1.secureserver.net";
//$mail->Port       = 465;

//From email address and name
$mail->From = "unisales@unisales.co.uk";
$mail->FromName = "Unisales";

//To address and name
$mail->addAddress("zcabjna@ucl.ac.uk", "Axel Amer UCL");

//Address to which recipient will reply
$mail->addReplyTo("unisales@unisales.com", "Reply");

//CC and BCC
//$mail->addCC("cc@example.com");
//$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Thanks for registering";
$mail->Body = "<strong>test</strong> for registering.</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message has been sent successfully";
}