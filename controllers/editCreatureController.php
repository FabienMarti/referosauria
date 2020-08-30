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
    }

    if(isset($_POST['sendEditedCrea'])){

        //Contrôle de l'habitat
        if(!empty($_POST['habitat'])) {
            $creature->environment = htmlspecialchars($_POST['habitat']);  
        }else{
            $formErrors['habitat'] = 'Veuillez sélectionner un habitat';
        }

        //Contrôle de la période
        if(!empty($_POST['period'])) {
            $creature->period = intval(htmlspecialchars($_POST['period']));            
        }else{
            $formErrors['period'] = 'Veuillez sélectionner une période';
        }

        if(!empty($_POST['predatory'])) {
            $creature->predatory = htmlspecialchars($_POST['predatory']);            
        }else{
            $formErrors['predatory'] = 'Veuillez renseigner un ou plusieurs prédateurs';
        }

        //Contrôle alimentation
        if(!empty($_POST['diet'])) {
            $creature->diet = intval(htmlspecialchars($_POST['diet']));
        }else{
            $formErrors['diet'] = 'Veuillez sélectionner une alimentation';
        }
    }