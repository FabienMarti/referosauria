<?php
$formErrors = array();

if(isset($_POST['sendMail'])){

    if(!empty($_POST['mail'])){
        $mail = htmlspecialchars($_POST['mail']);
    }else{
        $formErrors['mail'] = 'Veuillez renseigner une adresse e-mail.';
    }

    if(!empty($_POST['subject'])){
        $subject = htmlspecialchars($_POST['subject']);
    }else{
        $formErrors['subject'] = 'Veuillez renseigner un sujet.';
    }

    if(isset($_POST['message'])){
        $message = $_POST['message'];
    }

    if(empty($formErrors)){
        var_dump($mail);
        var_dump($subject);
        var_dump($message);
        if(mail($mail, $subject, $message)){
            echo 'SUCCESS';
        }else{
            echo 'FAIL';
        }
    }
}