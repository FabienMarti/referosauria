<?php
$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%');
$formErrors = array();

if(isset($_POST['validateForm'])){
    if(count($_POST) > 0){

        if(!empty($_POST['email'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $email = htmlspecialchars($_POST['email']);
            }else{
                $formErrors['email'] = 'Merci de respecter le format d\'e-mail valide.';
            }
        }else{
            $formErrors['email'] = 'Veuillez renseigner votre e-mail.'; 
        }

        if(!empty($_POST['confirmEmail'])){
            if(filter_var($_POST['confirmEmail'], FILTER_VALIDATE_EMAIL)){
                $confirmEmail = htmlspecialchars($_POST['confirmEmail']);
            }else{
                $formErrors['confirmEmail'] = 'Merci de respecter le format d\'e-mail valide.';
            }
        }else{
            $formErrors['confirmEmail'] = 'Veuillez renseigner votre e-mail.'; 
        }

        if(!empty($_POST['username'])){
            if(preg_match($regexList['username'], $_POST['username'])){
                $username = htmlspecialchars($_POST['username']);
            }else{
                $formErrors['username'] = 'Merci de respecter le format lettres, numéros sans caractères spéciaux.';
            }
        }else{
            $formErrors['username'] = 'Veuillez renseigner un nom d\'utilisateur.'; 
        }

        if(!empty($_POST['password'])){
            if(preg_match($regexList['password'], $_POST['password'])){
                $password = htmlspecialchars($_POST['password']);
            }else{
                $formErrors['password'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
            }
        }else{
            $formErrors['password'] = 'Veuillez renseigner un mot de passe.'; 
        }

        if(!isset($_POST['validate'])){
            $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
        }
    }
}