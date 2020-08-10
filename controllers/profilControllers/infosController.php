<?php

$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%');
$profilErrors = array();

$user = new user();
$showUserInfo = $user->getUserInfos();

if(isset($_POST['validateInfoEdit'])){
  
    if(count($_POST) > 0){
        
        if(!empty($_POST['mail'])){
            if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $profilErrors['mail'] = 'Merci de respecter le format d\'e-mail valide.';
            }
        }else{
            $profilErrors['mail'] = 'Veuillez renseigner votre e-mail.'; 
        }

        if(!empty($_POST['username'])){
            if(preg_match($regexList['username'], $_POST['username'])){
                $user->username = htmlspecialchars($_POST['username']);
            }else{
                $profilErrors['username'] = 'Merci de respecter le format lettres, numéros sans caractères spéciaux.';
            }
        }else{
            $profilErrors['username'] = 'Veuillez renseigner un nom d\'utilisateur.'; 
        }

        //SI il n'y a aucune erreur, on valide la modification
        if(empty($profilErrors)){
            if($user->editUserInfo()){
                $succesEdit = 'Vos informations ont bien été modifiées.';
            }
        }
    }
}