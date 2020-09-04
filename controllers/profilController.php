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
            '#'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    case 'Modérateur':
        $profilOptions = array(
            'infos'=>'Mes informations',
            'editPW'=>'Changer le mot de passe',
            '#'=>'Mes derniers posts',
            'deleteProfil'=>'Supprimer le compte',
            '#'=>'Déconnexion'
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
            '#'=>'Déconnexion'
        );
        $showLightUserInfo = $user->getUserInfos();
    break;
    default:
}