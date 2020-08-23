<?php
/* $contentArray = array('home' => 'Accueil', 'dinoList' => 'Liste des dinosaures', 'passwordRecovery' => 'Récupération de mot de passe', 'adminPanel' => 'Administration', 'profil' => 'Mon profil', 'discover' => 'Découvrir', 'addDino' => 'Déposer un article', 'registration' => 'S\inscrire', 'contribute' => 'Faire un don', 'quiz' => 'Quiz', 'forum' => 'Forum', 'creature' => 'Créature');
if(isset($_GET['content'])){
    if(isset($contentArray[$_GET['content']])){
    //si la valeur 'content' existe et que sa valeur est égale à une des clés associatives et du tableau $contentArray
        if(isset($_GET['content']) && (isset($contentArray[$_GET['content']]))) {
            $pageTitle = $contentArray[$_GET['content']];
            $page = htmlspecialchars($_GET['content']);
            $content = 'views/' . $page . '.php';
        } else {
            $pageTitle = 'Accueil';
            $content = 'views/home.php';
        }
    }
}else {
    $pageTitle = 'Accueil';
    $content = 'views/home.php';
} */

