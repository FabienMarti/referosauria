<?php
if(isset($_POST['login'])){

    $formErrors = array();
    $user = new user(); 

    if(empty($_POST['username'])){
        $formErrors['username'] = USERNAME_ERROR_EMPTY;
    }
    if(!empty($_POST['username'])){
        $user->username = htmlspecialchars($_POST['username']);
    }else{
        $formErrors['mausernameil'] = USERNAME_ERROR_EMPTY;
    }

    if(empty($_POST['password'])){        
        $formErrors['password'] = PASSWORD_ERROR_EMPTY;
    }
    

    if(empty($formErrors)){
        //On récupère le hash de l'utilisateur
       $hash = $user->getUserPasswordHash();
       //Si le hash correspond au mot de passe saisi
       if(password_verify($_POST['password'], $hash)){
           //On récupère son profil
            $userProfil = $user->getUserProfile();
            //On met en session ses informations
            $_SESSION['profile']['id'] = $userProfil->id;
            $_SESSION['profile']['username'] = $userProfil->username;
            $_SESSION['profile']['role'] = $userProfil->rolName;
            $_SESSION['profile']['roleId'] = $userProfil->rolName;
            header('location:index.php');
            exit();
       }else{
           $formErrors['password'] = $formErrors['mail'] = LOGIN_ERROR;
       }
    }
}