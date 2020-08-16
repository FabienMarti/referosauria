<?php
//je créé une nouvelle instance de l'objet 'creature'
$creature = new creature();
//je récupère le contenu ma methode getDinoInfos() dans une variable


if(isset($_POST['diet'])){
    $showCreaturesInfo = $creature->filterDino($_POST['diet']);
}else{
    $showCreaturesInfo = $creature->getDinosInfo();
}
$showCreaturePeriod = $creature->getDinoFilters();

$dinoPeriod = array('Trias', 'Jurassique', 'Crétacé');
$dinoType = array('1' => 'Carnivore', '2' => 'Herbivore', '3' => 'Piscivore');
$discoverers = array();
/* 
    if(isset($_GET['sendFilter'])){
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

    