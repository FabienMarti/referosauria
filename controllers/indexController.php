<?php

$contentArray = array('home', 'dinoList');

if(!empty($_GET['content'])){
    if(in_array($_GET['content'], $contentArray)){
        $content = 'views/' . $_GET['content'] . '.php';
        
    }else{
        header('Location: index.php');
    }




    
}else{
    $content = 'views/home.php';
}




/* if(!empty($_GET['content'])){
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