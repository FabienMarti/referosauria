<?php
//gestion de l'affichage
$user = new user();
//roles = Membre, Administrateur, Modérateur
$_SESSION['role'] = 'Membre';
$roles = array('Administrateur', 'Membre', 'Modérateur');

switch (htmlspecialchars($_SESSION['role'])) {
    case 'Membre':
        $profilOptions = array(
            'index.php?content=profil&profilContent=infos'=>'Mes informations',
            'index.php?content=profil&profilContent=editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'index.php?content=profil&profilContent=deleteProfil'=>'Supprimer le compte',
            'views/logout.php'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    case 'Modérateur':
        $profilOptions = array(
            'index.php?content=profil&profilContent=infos'=>'Mes informations',
            'index.php?content=profil&profilContent=editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'index.php?content=profil&profilContent=deleteProfil'=>'Supprimer le compte',
            'views/logout.php'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    case 'Administrateur':
        $profilOptions = array(
            'index.php?content=profil&profilContent=infos'=>'Mes informations',
            'index.php?content=profil&profilContent=editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'index.php?content=adminPanel' => 'Panel d\'administration',
            'index.php?content=profil&profilContent=deleteProfil'=>'Supprimer le compte',
            'views/logout.php'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    default:
}






// gestion du contenu
$profilContentArray = array('infos' => 'Mon compte', 'editPW' => 'Modifier mot de passe', 'deleteProfil' => 'Suppression de compte');
if(isset($_GET['profilContent'])){
    
    $getProfilContent = htmlspecialchars($_GET['profilContent']);

    if(isset($profilContentArray[$getProfilContent])){
        $pageTitle = $profilContentArray[$getProfilContent];
        $profilContent = 'views/profil/' . $getProfilContent . '.php';  
    }else{
            $pageTitle = 'Mon compte';
            $profilContent = 'views/profil/infos.php';
        }
}else {
    $pageTitle = 'Mon compte';
    $profilContent = 'views/profil/infos.php';
}

