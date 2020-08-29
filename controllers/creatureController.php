<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
  
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
       //coder quelquechose
    }
   