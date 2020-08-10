<?php
$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%');
$formErrors = array();

$user = new user();

if(isset($_POST['validateForm'])){
    
    if(count($_POST) > 0){
        if(!empty($_POST['mail'])){
            if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $formErrors['mail'] = 'Merci de respecter le format d\'e-mail valide.';
            }
        }else{
            $formErrors['mail'] = 'Veuillez renseigner votre e-mail.'; 
        }

        if(!empty($_POST['confirmMail'])){
            if(filter_var($_POST['confirmMail'], FILTER_VALIDATE_EMAIL)){
                $confirmMail = htmlspecialchars($_POST['confirmMail']);
            }else{
                $formErrors['confirmMail'] = 'Merci de respecter le format d\'e-mail valide.';
            }
        }else{
            $formErrors['confirmMail'] = 'Veuillez renseigner votre e-mail.'; 
        }

        if(!empty($_POST['username'])){
            if(preg_match($regexList['username'], $_POST['username'])){
                $user->username = htmlspecialchars($_POST['username']);
            }else{
                $formErrors['username'] = 'Merci de respecter le format lettres, numéros sans caractères spéciaux.';
            }
        }else{
            $formErrors['username'] = 'Veuillez renseigner un nom d\'utilisateur.'; 
        }

        if(!empty($_POST['password'])){
            if(preg_match($regexList['password'], $_POST['password'])){
                $user->pass = htmlspecialchars($_POST['password']);
            }else{
                $formErrors['password'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
            }
        }else{
            $formErrors['password'] = 'Veuillez renseigner un mot de passe.'; 
        }

        if(!isset($_POST['validate'])){
            $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
        }

        if(empty($formErrors)){
            $user->addNewUser();
        }
    }
}