<?php
//je créé une nouvelle instance de l'objet 'creature'
$creature = new creature();
//je récupère le contenu ma methode getDinoInfos() dans une variable
$showCreaturesInfo = $creature->getDinosInfo();
$showCreaPeriods = $creature->getCreaPeriods();
$showCreaDiets = $creature->getCreaDiets();
$showCreaCategories = $creature->getCreaCategories();

//On rédéfinie la VAR des resultats en avec une methode associé qui affiche tout, ou le resultat de notre recherche
if(isset($_GET['sendSearch'])){
    $search = htmlspecialchars($_GET['search']);
    $resultsNumber = $creature->countSearchResult($search);
    if($resultsNumber == 0){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $showCreaturesInfo = $creature->searchCreaByName($search);
    }
}else{
    $showCreaturesInfo = $creature->getDinosInfo();
}