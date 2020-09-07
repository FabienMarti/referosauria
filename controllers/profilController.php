<?php
//gestion de l'affichage
$user = new user();
$user->id = $_SESSION['profile']['id'];
switch (htmlspecialchars($_SESSION['profile']['role'])) {
    case 'Membre':
        $profilOptions = array(
            'infos'=>'Mes informations',
            'editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'deleteProfil'=>'Supprimer le compte',
            '../index.php?action=disconnect'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    case 'Modérateur':
        $profilOptions = array(
            'infos'=>'Mes informations',
            'editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'deleteProfil'=>'Supprimer le compte',
            '../index.php?action=disconnect'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    case 'Administrateur':
        $profilOptions = array(
            'infos'=>'Mes informations',
            'editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'adminPanel' => 'Panel d\'administration',
            'deleteProfil'=>'Supprimer le compte',
            '../index.php?action=disconnect'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    default: break;
}


$user = new user();
$deleteProfilErrors = array();
$currentPassword = $user->getCurrentPassword();


if(isset($_POST['validateDelete'])){
    if(count($_POST) > 0){

        if(htmlspecialchars($_POST['pass']) != $currentPassword->password){
            $deleteProfilErrors['pass'] = 'Mot de passe incorrect';
        }

        if(htmlspecialchars($_POST['deleteTXT']) != 'Supprimer'){
            $deleteProfilErrors['deleteTXT'] = 'Orthographe incorrecte';
        }

        if(!isset($_POST['check'])){
            $deleteProfilErrors['check'] = 'Veuillez accepter les conditions de suppression de compte';
        }

        if(empty($deleteProfilErrors)){
            $user->deleteSelectedUser();
            $isAccountDeleted = true;
        }
    }
}


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