<?php
$passwordRegex =  '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%';
$profilErrors = array();

$user = new user();
$currentPassword = $user->getCurrentPassword();

if(isset($_POST['validateEdit'])){

    if(count($_POST) > 0){

        if(htmlspecialchars($_POST['oldPW']) == $currentPassword->password){
            if(htmlspecialchars($_POST['newPW']) != $currentPassword->password){
                if(preg_match($passwordRegex, htmlspecialchars($_POST['newPW']))){
                    $user->password = htmlspecialchars($_POST['newPW']);
                }else{
                    $profilErrors['newPW'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
                }
            }else{
                $profilErrors['newPW'] = 'Votre nouveau mot de passe ne doit pas être identique à l\'ancien';
            }
        }else{
            $profilErrors['oldPW'] = 'Votre ancien mot de passe n\'est pas bon';
        }


        if(empty($profilErrors)){
            $user->editUserPW();
            $pwEditSuccess = 'Le mot de passe à bien été modifié.';
        }else{
            $pwEditSuccess = 'Une erreur est survenue, veuillez contacter un résponsable technique.';
        }
    }
}