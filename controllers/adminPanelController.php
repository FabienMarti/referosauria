<?php
$user = new user();
$creature = new creature();
$formErrors = array();
$itemsPerPage = array(5, 10, 15, 20);
//Controlleur suppression
if(isset($_POST['deleteProfil'])){

    if(!empty($_POST['recipient-name'])){
        $user->id = htmlspecialchars($_POST['recipient-name']);
        $user->deleteUserById();
    }
}

/******************* PAGINATION ET FILTRAGE ***********************/

$search = array();
if (isset($_GET['page'])){
    $page = $_GET['page'];
}else {
    $page = 1;
}

//Défini le nombre de resultats par page
$itemsOnThisPage = 5;
if(isset($_POST['nbItems'])){
    if(in_array($_POST['nbItems'], $itemsPerPage)){
        $itemsOnThisPage = htmlspecialchars($_POST['nbItems']);
    }else{
        $formErrors['nbItems'] = 'Le nombre d\'objets par page n\'est pas autorisé !';
    }
}

$limitArray = ['limit'=>$itemsOnThisPage];
//Calcule l'offset
$limitArray['offset'] = ($page * $limitArray['limit']) - $limitArray['limit'];
//Affiche le résultat de la recherche si le formulaire est validé, sinon affiche toute la liste avec la pagination
if(isset($_POST['searchUser'])) {
    if (!empty($_POST['searchField'])){
        $search['username'] = htmlspecialchars($_POST['searchField']) . '%';
    }

    /* if (!empty($_POST['searchbydate']) && preg_match($regexBirthDate, $_POST['searchbydate'])){
        $search['birthdate'] = htmlspecialchars($_POST['searchbydate']);
    } */
    $showUserInfo = $user->getUserList($limitArray, $search);
    //Compte le nombre de pages en fonction du nombre de resultats
    $pageNumber = ceil(count($user->getUserList(array(),$search)) / $limitArray['limit']);
}else {
    //Affiche la liste des utilisateurs normalement
    $showUserInfo = $user->getUserList($limitArray);
    //Compte le nombre de pages
    $pageNumber = ceil(count($user->getUserList()) / $limitArray['limit']);
}

$showCreaturesInfos = $creature->getDinosInfoAsAdmin();