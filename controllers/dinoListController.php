<?php
$formErrors = array();
//je créé une nouvelle instance de l'objet 'creature'
$creature = new creature();
//je récupère le contenu ma methode getDinoInfos() dans une variable
$showCreaturesInfo = $creature->getDinosInfo();
$showCreaPeriods = $creature->getCreaPeriods();
$showCreaDiets = $creature->getCreaDiets();
$showCreaCategories = $creature->getCreaCategories();

/************************************ SECTION DE RECHERCHE et PAGINATION ***************************/

$search = array();

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = 1;
}

//Défini le nombre de resultats par page
$limitArray = ['limit' => 6];
//Calcule l'offset
$limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];

//Affiche le résultat de la recherche si le formulaire est validé, sinon affiche toute la liste avec la pagination
if(isset($_POST['searchCrea'])) {

    //Recherche via champ de recherche.
    if (!empty($_POST['searchField'])){
        $search['name'] = htmlspecialchars($_POST['searchField']) . '%';
    }

    //Recherche via Filtres
    if(!empty($_POST['diet'])){
        $search['diet'] = intval($_POST['diet']);
    }

    if(!empty($_POST['categories'])){
        $search['categories'] = intval($_POST['categories']);
    }

    if(!empty($_POST['period'])){
        $search['period'] = intval($_POST['period']);
    }

    $showCreaList = $creature->getCreaList($limitArray, $search);
    //Compte le nombre de pages en fonction du nombre de resultats
    $pageNumber = ceil(count($creature->getCreaList(array(),$search)) / $limitArray['limit']);
}else {
    //Affiche la liste des creatures normalement
    $showCreaList = $creature->getCreaList($limitArray);
    //Compte le nombre de pages
    $pageNumber = ceil(count($creature->getCreaList()) / $limitArray['limit']);
}
/*************************************************************************************************/


/******************************************* TRANSACTION **************************************************/

//try catch permet d'isoler une erreur éventuelle ...
if(count($formErrors) == 25500){
    try{
        $creature->beginTransaction();
        //!methode d'ajout 1
        //recupere le dernier ID utilisé pour l'inserer dans la seconde insertion
        /* $objet2->id = */ $creature->lastInsertId();
        //!methode d'ajout 2
        //commit pour valider les lignes précedentes
        $creature->commit();
    }
    //Exception : erreur systeme, demande d'avoir une action derrière
    catch(Exception $e){
        $creature->rollBack();
    }
}