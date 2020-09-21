<?php

$creature = new creature();

//Controlleur suppression
if(isset($_POST['deleteCrea'])){

    if(!empty($_POST['recipient-name'])){
        $creature->id = htmlspecialchars($_POST['recipient-name']);
        $creature->deleteCreaById();
    }
}

if(isset($_POST['validateCrea'])){

    if(!empty($_POST['recipient-name2'])){
        $creature->id = htmlspecialchars($_POST['recipient-name2']);
        $creature->validateCrea();
    }
}

/************************************ PAGINATION ET FILTRAGE *************************************/

$search = array();
if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = 1;
}

$limitArray = ['limit'=>10];
//Calcule l'offset
$limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
//Affiche le résultat de la recherche si le formulaire est validé, sinon affiche toute la liste avec la pagination
if(isset($_POST['searchCrea'])) {
    //Recherche via champ de recherche.
    if (!empty($_POST['searchField'])){
        $search['name'] = htmlspecialchars($_POST['searchField']) . '%';
    }
    $showCreaList = $creature->getCreaListAsAdmin($limitArray, $search);
    //Compte le nombre de pages en fonction du nombre de resultats
    $pageNumber = ceil(count($creature->getCreaListAsAdmin(array(),$search)) / $limitArray['limit']);
}else {
    //Affiche la liste des creatures normalement
    $showCreaList = $creature->getCreaListAsAdmin($limitArray);
    //Compte le nombre de pages
    $pageNumber = ceil(count($creature->getCreaListAsAdmin()) / $limitArray['limit']);
}