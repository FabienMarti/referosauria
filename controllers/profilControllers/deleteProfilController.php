<?php
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