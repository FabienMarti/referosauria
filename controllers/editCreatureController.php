<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();

    $showDiets = $creature->getCreaDiets();
    $showCategories = $creature->getCreaCategories();
    $showPeriods = $creature->getCreaPeriods();
    $showDiscoverers = $creature->getCreaDiscoverers();
    $showEnvironments = $creature->getCreaEnvironments();

    if(!empty($_GET['id'])){
        $creature->id = htmlspecialchars($_GET['id']);
        $showCreatureInfo = $creature->getSingleDinoInfo();
    }else{
        header('Location: dinoList.php');
        exit;
    }
    
    $areaMap = 0;
    foreach ($showEnvironments as $env) {
        if($showCreatureInfo->envId == $env->id){
            $areaMap =  $env->id;
        }
    }

    if(isset($_POST['sendEditedCrea'])){

    /********************************* FICHE SIGNALETIQUE **************************************/

        //Contrôle de l'habitat
        if(!empty($_POST['habitat'])) {
            $creature->environment = htmlspecialchars($_POST['habitat']);  
        }else{
            $creature->environment = $showCreatureInfo->envId;
        }

        //Contrôle de la période
        if(!empty($_POST['period'])) {
            $creature->period = htmlspecialchars($_POST['period']);            
        }else{
            $creature->period = $showCreatureInfo->perId;
        }

        //Predateurs
        if(!empty($_POST['predatory'])) {
            $creature->predatory = htmlspecialchars($_POST['predatory']);            
        }else{
            $formErrors['predatory'] = 'Veuillez renseigner un';
        }

        //Contrôle alimentation
        if(!empty($_POST['diet'])) {
            $creature->diet = htmlspecialchars($_POST['diet']);
        }else{
            $creature->diet = $showCreatureInfo->dietId;
        }

        //Longueur Mini
        if(!empty($_POST['minWidth'])) {
            $creature->minWidth = (htmlspecialchars($_POST['minWidth']));
        }else{
            $formErrors['minWidth'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Maxi
        if(!empty($_POST['maxWidth'])) {
            $creature->maxWidth = (htmlspecialchars($_POST['maxWidth']));
        }else{
            $formErrors['maxWidth'] = 'Veuillez sélectionner une alimentation';
        }

        //Longueur Hauteur
        if(!empty($_POST['minHeight'])) {
            $creature->minHeight = (htmlspecialchars($_POST['minHeight']));
        }else{
            $formErrors['minHeight'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Hauteur
        if(!empty($_POST['maxHeight'])) {
            $creature->maxHeight = (htmlspecialchars($_POST['maxHeight']));
        }else{
            $formErrors['maxHeight'] = 'Veuillez sélectionner une alimentation';
        }

        //Longueur Poids
        if(!empty($_POST['minWeight'])) {
            $creature->minWeight = (htmlspecialchars($_POST['minWeight']));
        }else{
            $formErrors['minWeight'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Poids
        if(!empty($_POST['maxWeight'])) {
            $creature->maxWeight = (htmlspecialchars($_POST['maxWeight']));
        }else{
            $formErrors['maxWeight'] = 'Veuillez sélectionner une alimentation';
        }

        //Categories
        if(!empty($_POST['categories'])){
            $creature->categories = htmlspecialchars($_POST['categories']);
        }else{
            $creature->categories = $showCreatureInfo->catId;
        }

        //Description
        if(!empty($_POST['description'])) {
            $creature->description = htmlspecialchars($_POST['description']);            
        }else{
            $formErrors['description'] = 'Veuillez renseigner un';
        }

        //Nom
        if(!empty($_POST['creaName'])) {
            $creature->name = htmlspecialchars($_POST['creaName']);            
        }else{
            $formErrors['creaName'] = 'Veuillez renseigner un';
        }

        //Main Image

        //Mini Image

        //Paleonthologue découvreur
        if(!empty($_POST['discovery'])) {
            $creature->discovery = htmlspecialchars($_POST['discovery']);            
        }else{
            $formErrors['discovery'] = 'Veuillez renseigner un';
        }

        if(empty($formErrors)){
            $creature->mainImage = $showCreatureInfo->mainImage;
            $creature->miniImage = $showCreatureInfo->miniImage;
            $creature->updateCreaAsAdmin();
            if(!empty($_GET['id'])){
                $creature->id = htmlspecialchars($_GET['id']);
                $showCreatureInfo = $creature->getSingleDinoInfo();
            }
        }
    }