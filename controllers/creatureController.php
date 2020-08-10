<?php
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    //je récupère le contenu ma methode getDinoInfos() dans une variable
    $showCreatureInfo = $creature->getSingleDinoInfo(htmlspecialchars($_GET['id']));