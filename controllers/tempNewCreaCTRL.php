<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();

    $showDiets = $creature->getCreaDiets();
    $showCategories = $creature->getCreaCategories();
    $showPeriods = $creature->getCreaPeriods();
    $showDiscoverers = $creature->getCreaDiscoverers();
    $showEnvironments = $creature->getCreaEnvironments();

    /* 
    if(!empty($_GET['id'])){
        $creature->id = htmlspecialchars($_GET['id']);
        $showCreatureInfo = $creature->getSingleDinoInfo();
        $creature->period = $showCreatureInfo->period;
        $showCreaturesByPeriod = $creature->getCreaturesByPeriod();
    }else{
        header('Location: dinoList.php');
        exit;
    }
    
    $areaMap = 0;
    foreach ($showEnvironments as $env) {
        if($showCreatureInfo->envId == $env->id){
            $areaMap =  $env->id;
        }
    } */

    if(isset($_POST['sendEditedCrea'])){

    /********************************* FICHE SIGNALETIQUE **************************************/

        //Contrôle de l'habitat
        if(!empty($_POST['habitat'])) {
            $creature->environment = htmlspecialchars($_POST['habitat']);  
        }else{
            $formErrors['habitat'] = 'Veuillez sélectionner un habitat';
        }

        //Contrôle de la période
        if(!empty($_POST['period'])) {
            $creature->period = (htmlspecialchars($_POST['period']));            
        }else{
            $formErrors['period'] = 'Veuillez sélectionner une période';
        }

        //Predateurs
        if(!empty($_POST['predatory'])) {
            $creature->predatory = htmlspecialchars($_POST['predatory']);            
        }else{
            $formErrors['predatory'] = 'Veuillez renseigner un ou plusieurs prédateurs';
        }

        //Contrôle alimentation
        if(!empty($_POST['diet'])) {
            $creature->diet = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['diet'] = 'Veuillez sélectionner une alimentation';
        }

        //Longueur Mini
        if(!empty($_POST['minWidth'])) {
            $creature->minWidth = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['minWidth'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Maxi
        if(!empty($_POST['maxWidth'])) {
            $creature->maxWidth = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['maxWidth'] = 'Veuillez sélectionner une alimentation';
        }

        //Longueur Hauteur
        if(!empty($_POST['minHeight'])) {
            $creature->minHeight = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['minHeight'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Hauteur
        if(!empty($_POST['maxHeight'])) {
            $creature->maxHeight = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['maxHeight'] = 'Veuillez sélectionner une alimentation';
        }

        //Longueur Poids
        if(!empty($_POST['minWeight'])) {
            $creature->minWeight = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['minWeight'] = 'Veuillez sélectionner une alimentation';
        }
        //Longueur Poids
        if(!empty($_POST['maxWeight'])) {
            $creature->maxWeight = (htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['maxWeight'] = 'Veuillez sélectionner une alimentation';
        }

        if(empty($formErrors)){
            
        }

        /********************************* FIN FICHE SIGNALETIQUE **************************************/

    }