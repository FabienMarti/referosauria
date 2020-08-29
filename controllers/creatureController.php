<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    $environmentArray = array('1' => 'Amérique du Nord', '2' => 'Amérique du Sud', '3' => 'Europe', '4' => 'Asie', '5' => 'Afrique', '6' => 'Océanie', '7' => 'Antartique' );

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
    $areaMap = 0;
    if(in_array($showCreatureInfo->environment, $environmentArray)){
        foreach ($environmentArray as $area => $title) {
            if($showCreatureInfo->environment == $title){
                $areaMap =  $area;
            }
        }
    }
   