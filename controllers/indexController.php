<?php

$contentArray = array('Accueil' => 'home', 'Liste des dinosaures' => 'dinoList', 'Découvrir' => 'discover', 'Déposer un article' => 'addDino','S\'inscrire' => 'registration', 'Faire un don' => 'contribute', 'Quiz' => 'quiz', 'Forum' => 'forum');

if(isset($_GET['content']) && in_array($_GET['content'], $contentArray))  {
    foreach ($contentArray as $title => $value) {
        if($_GET['content'] == $value){
            $content = 'views/' . $_GET['content'] . '.php';
            $pageTitle = $title;
        }
    }
}else{
    $content = 'views/home.php';
}

/*Switch
if(!empty($_GET['content'])){
    switch ($_GET['content']) {
        case 'home':
           $content = 'views/home.php';
           $pageTitle = 'Accueil';
        break;
        case 'dinoList':
            $content = 'views/dinoList.php';
            $pageTitle = 'Liste des créatures';
        default:    
    }
}else{
    $content = 'views/home.php';
} */