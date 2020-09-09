<?php

$formErrors = array();
 // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
 $headers = 'MIME-Version: 1.0' . '\n';
 $headers .= 'Content-type: text/html; charset=utf-8' . '\n';

 // En-têtes additionnels
 $headers .= 'From: Webmaster <no-reply@dinox.com>' . '\r\n';

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

    /* if(isset($_POST['message'])){
        $message = $_POST['message'];
    } */

    $message = '<h1>Salut John!</h1>';
    $message .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin efficitur, velit quis eleifend fringilla, urna lectus finibus est, ut aliquam nulla tellus vel ipsum. Pellentesque in vulputate leo, sit amet mattis sem. Sed id gravida turpis, et luctus augue. Ut vitae ipsum volutpat, cursus dui sit amet, egestas mi. Etiam bibendum, dolor in sollicitudin facilisis, diam odio ultricies ligula, sit amet rutrum diam justo at eros. Nam mollis efficitur vestibulum. Aenean mi enim, tempus et ornare et, convallis vitae odio. Aliquam tincidunt, massa hendrerit volutpat faucibus, nulla erat lobortis nulla, vitae egestas lectus est sit amet nibh. Ut pretium ligula non risus sollicitudin, porta laoreet sem viverra. Praesent vulputate purus massa, vitae luctus nunc rutrum quis. Vestibulum dignissim semper urna, in rhoncus tortor. Quisque volutpat massa nisl, sit amet elementum nibh lobortis id. Vestibulum mollis leo ex, non aliquam risus lobortis a.</p>';
    if(empty($formErrors)){

        if(mail($mail, 'Validation de votre inscription',$message , $headers)){
            
            $messageSuccess = 'Message bien envoyé à ' . $mail;
        }else{
            $messageFail = 'Echec de l\'envoi du message';
        }
    }
}