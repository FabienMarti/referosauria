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
        $formErrors['username'] = USERNAME_ERROR_EMPTY;
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
            $_SESSION['profile']['password'] = $_POST['password'];
            //cookies pour garder en mémoire le mot de passe et le nom d'utilisateur
            setcookie('username', $_SESSION['profile']['username'], time() + (3600 * 24 * 365), '/');
            header('location: ../index.php');
            exit();
       }else{
           $formErrors['password'] = $formErrors['mail'] = LOGIN_ERROR;
       }
    }
}

//Traitement de la demande AJAX => Correspondance Regex, 'password' et 'username'
if(isset($_POST['passwordValue'])){
    //On vérifie que l'on a bien envoyé des données en POST
    if(!empty($_POST['passwordValue']) && !empty($_POST['usernameValue'])){
        //On inclut les bons fichiers car dans ce contexte ils ne sont pas connu.
        $_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
        include_once $linkModif . 'config.php';
        include_once $linkModif . 'models/database.php';
        include_once $linkModif . 'models/userModel.php';
        $passwordValue = htmlspecialchars($_POST['passwordValue']);
        $usernameValue = htmlspecialchars($_POST['usernameValue']);
        //Le echo sert à envoyer la réponse au JS
        $user = new user;
        $user->username = $usernameValue;
        $hash = $user->getUserPasswordHash();
        //Si le hash correspond au mot de passe saisi
        if(password_verify($_POST['passwordValue'], $hash)){
            echo 1;
        }else{
            echo 2;
        } 
    }else{
        echo 2;
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