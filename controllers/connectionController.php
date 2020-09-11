<?php
if(isset($_POST['login'])){

    $formErrors = array();
    $user = new user(); 

    if(!empty($_POST['usernameConnect'])){
        $user->username = htmlspecialchars($_POST['usernameConnect']);
    }else{
        $formErrors['usernameConnect'] = USERNAME_ERROR_EMPTY;
        $script = '$(\'#modalConnection\').modal({show:true})';
    }

    if(empty($_POST['passwordConnect'])){        
        $formErrors['passwordConnect'] = PASSWORD_ERROR_EMPTY;
        $script = '$(\'#modalConnection\').modal({show:true})';
    }
    
    if(empty($formErrors)){
        //On récupère le hash de l'utilisateur
       $hash = $user->getUserPasswordHash();
       //Si le hash correspond au mot de passe saisi
       if(password_verify($_POST['passwordConnect'], $hash)){
           //On récupère son profil
            $userProfil = $user->getUserProfile();
            //On met en session ses informations
            $_SESSION['profile']['id'] = $userProfil->id;
            $_SESSION['profile']['username'] = $userProfil->username;
            $_SESSION['profile']['role'] = $userProfil->rolName;
            $_SESSION['profile']['roleId'] = $userProfil->rolName;
            //cookies pour garder en mémoire le mot de passe et le nom d'utilisateur
            setcookie('username', $_SESSION['profile']['username'], time() + (3600 * 24 * 365), '/');
          
       }else{
           $formErrors['passwordConnect'] = $formErrors['usernameConnect'] = LOGIN_ERROR;
           $script = '$(\'#modalConnection\').modal({show:true})';
       }
    }
}

//Gestion des actions
if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        //Pour deconnecter l'utilisateur on détruit sa session
        session_destroy();
        //Et on le redirige vers l'accueil
        header('location:index.php');
        exit();
    }
}