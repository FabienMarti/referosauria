<?php
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
$limitArray = ['limit'=>5];
//Calcule l'offset
$limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
//Affiche le résultat de la recherche si le formulaire est validé, sinon affiche toute la liste avec la pagination
if(isset($_POST['searchCrea'])) {
    if (!empty($_POST['searchField'])){
        $search['name'] = htmlspecialchars($_POST['searchField']) . '%';
    }
    /* if (!empty($_POST['searchbydate']) && preg_match($regexBirthDate, $_POST['searchbydate'])){
        $search['birthdate'] = htmlspecialchars($_POST['searchbydate']);
    } */
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