<?php
// gestion du contenu
$profilContentArray = array('infos' => 'Mon compte', 'editPW' => 'Modifier mot de passe');
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

//gestion de l'affichage
$user = new user();
$showLightUserInfo = $user->getUserInfos();