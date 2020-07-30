<?php
// $contentArray = array('Accueil' => 'home', 'Liste des dinosaures' => 'dinoList', 'Découvrir' => 'discover', 'Déposer un article' => 'addDino','S\'inscrire' => 'registration', 'Faire un don' => 'contribute', 'Quiz' => 'quiz', 'Forum' => 'forum');
$contentArray = array('home' => 'Accueil'
                ,'dinoList' => 'Liste des dinosaures'
                ,'discover' => 'Découvrir'
                ,'addDino' => 'Déposer un article'
                ,'registration' => 'S\inscrire'
                ,'contribute' => 'Faire un don'
                ,'quiz' => 'Quiz'
                ,'forum' => 'Forum');

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








/* if(isset($_GET['content']) && in_array($_GET['content'], $contentArray))  {
    foreach ($contentArray as $title => $value) {
        if($_GET['content'] == $value){
            $content = 'views/' . htmlspecialchars($_GET['content']) . '.php';
            $pageTitle = $title;
        }
    }
}else{
    $content = 'views/home.php';
} */

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