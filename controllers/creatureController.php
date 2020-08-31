<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    $showEnvironments = $creature->getCreaEnvironments();

    if(!empty($_GET['id'])){
        //récupère l'id de la créature en question
        $creature->id = htmlspecialchars($_GET['id']);
        //récupère le contenu ma methode getSingleDinoInfo() dans une variable
        $showCreatureInfo = $creature->getSingleDinoInfo();
        //stock l'ID de la période dans l'objet créature
        $creature->period = $showCreatureInfo->period;
        //va chercher les créatures de la même période
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

/*cas des INT dans recherche : on doit envoyer un tableau de tableaux ou tableau d'objet a la place d'un simple tableau
$tableau['champSQL'][type de données]   exemple ['type']ex: STR   || ['logical']ex: OR   ||  ['value']ex: 'toto' on utilise plus d'implode() */