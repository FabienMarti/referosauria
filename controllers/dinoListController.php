<?php
//je créé une nouvelle instance de l'objet 'creature'
$creature = new creature();
//je récupère le contenu ma methode getDinoInfos() dans une variable
$showCreaturesInfo = $creature->getDinosInfo();

/* if(isset($_POST['diet'])){
    $showCreaturesInfo = $creature->filterDino($_POST['diet']);
}else{
}*/

//$showCreaturePeriod = $creature->getDinoFilters();


/*if(isset($_GET['sendFilter'])){
    if(!empty($_GET['period'])){
        $period = htmlspecialchars($_GET['period']);
    }else{
        $period = '';
    }

    /* if(!empty($_GET['diet'])){
        $diet = htmlspecialchars($_GET['diet']);
    }else{

    }
} */

    