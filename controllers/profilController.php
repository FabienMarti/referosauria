<?php
//Regex pour vérifier le nom d'utilisateur et que le mot de passe contienne minimum 8 caractères, une majuscule, une minuscule ainsi qu'un nombre.
$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%');
//Nouvelle instance de l'objet user.
$user = new user();
//Récupère l'id de l'user sotckée dans la superglobale SESSION lors de la connexion.
$user->id = $_SESSION['profile']['id'];
//Tableau d'erreurs dédié au profil.
$profilErrors = array();
//Tableau d'erreurs dédié à la suppression du profil.
$deleteProfilErrors = array();
//Récupère le mot de passe de l'utilisateur.
$passwordHash = $user->getCurrentPasswordById();


//! LISTE DU MENU PROFIL
    //Switch pour déterminer en fonction du role le menu que l'utilisateur pourra avoir
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

//! SUPRESSION DU PROFIL

    if(isset($_POST['validateDelete'])){

        if(count($_POST) > 0){

            if(htmlspecialchars($_POST['pass']) != $currentPassword->password){
                $deleteProfilErrors['pass'] = 'Mot de passe incorrect';
            }

            if(htmlspecialchars($_POST['deleteTXT']) != 'Supprimer'){
                $deleteProfilErrors['deleteTXT'] = 'Orthographe incorrecte'; //changer
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

//! EDITION DU MOT DE PASSE
    //Vérifie que le formulaire qui a pour bouton 'validateEdit' à bien été envoyé.
    if(isset($_POST['validateEdit'])){
        //Vérifie que $_POST contient bien une ou plusieurs valeurs.
        if(count($_POST) > 0){
            //Vérifie que le mot de passe actuel corresponde à celui de la base de données.
            if(password_verify($_POST['oldPW'], $passwordHash)){
                //Vérifie que le nouveau mot de passe soit différent de l'ancien.
                if($_POST['newPW'] != $_POST['oldPW']){
                    //Vérifie que le nouveau mot de passe respecte notre Regex
                    if(preg_match($regexList['password'], $_POST['newPW'])){
                        //Hydrate le mot de passe hashé dans l'objet user
                        $user->password = password_hash($_POST['newPW'], PASSWORD_DEFAULT);
                    }else{
                        $profilErrors['newPW'] = 'Utilisez 8 caractères, minimum 1 lettre et 1 chiffre.';
                    }
                }else{
                    $profilErrors['newPW'] = 'Votre nouveau mot de passe ne doit pas être identique à l\'ancien';
                }
            }else{
                $profilErrors['oldPW'] = 'Votre ancien mot de passe n\'est pas bon';
            }

            //Vérifie si profilErrors est vide, si c'est le cas, on termine la modification du mot de passe.
            if(empty($profilErrors)){
                //Si la methode editUserPW s'execute sans erreur.
                if($user->editUserPW()){
                    //Alors on stock dans une variable un message de succes.
                    $succesEdit = 'Le mot de passe à bien été modifié.';
                }else{
                    //Sinon un message d'échec.
                    $failEdit = 'Une erreur est survenue, veuillez contacter un résponsable technique.';
                }
            }
        }
    }

//! EDITION DES INFORMATIONS DU PROFIL
    //Vérifie que le formulaire qui a pour bouton 'validateInfoEdit' à bien été envoyé.
    if(isset($_POST['validateInfoEdit'])){
        
        if(count($_POST) > 0){

            //Vérifie que $_POST['mail'] est vide.
            if(!empty($_POST['mail'])){
                //Vérifie si la saisie correspond au filtre choisi.
                if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                    //Hydrate l'attribut mail de l'objet user avec la saisie.
                    $user->mail = htmlspecialchars($_POST['mail']);
                }else{
                    $profilErrors['mail'] = 'Merci de respecter le format d\'e-mail valide.';
                }
            }else{
                $profilErrors['mail'] = 'Veuillez renseigner votre e-mail.'; 
            }

            //Vérifie que $_POST['username'] est vide.
            if(!empty($_POST['username'])){
                //Vérifie si la saisie respecte l'expression régulière.
                if(preg_match($regexList['username'], $_POST['username'])){
                    //Hydrate l'attribut username de l'objet user avec la saisie.
                    $user->username = htmlspecialchars($_POST['username']);
                }else{
                    $profilErrors['username'] = 'Merci de respecter le format lettres, numéros sans caractères spéciaux.';
                }
            }else{
                $profilErrors['username'] = 'Veuillez renseigner un nom d\'utilisateur.'; 
            }

            if(empty($profilErrors)){

                //Récupère les informations de l'utilisateur.
                $userInfo = $user->getUserInfos();
                //Déclaration d'une variable booléenne en true.
                $isOk = true;

                //Vérifie que si la saisie diffère des données de la base de données.
                if($_POST['mail'] != $userInfo->mail){
                    //Vérifie si l'email est déjà utilisé.
                    if($user->checkMailExists() == 1){
                        $profilErrors['mail'] = 'L\'adresse mail est déjà utilisée.';
                        $isOk = false;
                    }
                }
            
                if($_POST['username'] != $userInfo->username){
                    if($user->checkUsernameExists() == 1){
                        $profilErrors['username'] = 'Le nom d\'utilisateur est déjà utilisé.';
                        $isOk = false;
                    }
                }

                if($isOk == true){
                    $user->editUserInfo();
                    $successEdit = 'Les informations ont bien été modifées.';
                }else{
                    $failEdit = 'La modification des informations n\'a pu aboutir.';
                }
            }
        }
    }

$showUserInfo = $user->getUserInfos();