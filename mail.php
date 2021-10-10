<?php


use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require  "PHPMailer/Exception.php";
require  "PHPMailer/PHPMailer.php";
require  "PHPMailer/SMTP.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') { //If Request method is post

    $mail = new PHPMailer(); //Initialize the PHPMailer Object
    try {
        $mail->isSMTP();
        $mail->Host = ''; //SMTP HOST
        $mail->SMTPAuth = true;
        $mail->Username = ''; //Sender Mail
        $mail->Password = ''; //Password
        $mail->SMTPSecure = 'ssl'; //You can use 'tls' also
        $mail->Port = 465; //If you have used 'tls' as SMTPSecure then post '587'

        $mail->setFrom('from@gmail.com', 'From Name'); //Sender Mail & name. Name is optional.

        $mail->addAddress($_POST['email'], $_POST['name']); //Add a recipient
        $mail->addReplyTo($_POST['email'], $_POST['name']);

        $mail->addAttachment(__DIR__ . '/file/test.jpg');

        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'PHPMailer testing..';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo 'Message has been sent';
        } else {
            echo 'Failed to send message.';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
