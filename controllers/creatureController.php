<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    //je récupère le contenu ma methode getDinoInfos() dans une variable
    $creature->id = htmlspecialchars($_GET['id']);
    $showCreatureInfo = $creature->getSingleDinoInfo();