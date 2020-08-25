<?php
//Regex nom
$regexName = '%^[A-ÿ_\-\ ]{2,30}$%';

//Tableau des extensions de fichier autorisées
$extensionsWhiteList = array('jpg', 'png');

$creatureModel = new creature();
$showCreatureInfo = $creatureModel->getSingleDinoInfo();
//Tableau d'erreurs
$formErrors = array();

//Tableaux menu déroulants
$dinoPeriod = array('1' => 'Trias inférieur', '2' => 'Trias moyen', '3' => 'Trias supérieur', '4' => 'Jurassique inférieur', '5' => 'Jurassique moyen', '6' => 'Jurassique supérieur', '7' => 'Crétacé inférieur', '8' => 'Crétacé supérieur');
$dinoType = array('1' => 'Carnivore', '2' => 'Herbivore', '3' => 'Piscivore');
$environmentArray = array('Amérique du Nord', 'Amérique du Sud', 'Europe', 'Asie', 'Afrique', 'Océanie', 'Antartique' );
$categories = array('Dinosaure', 'Mammifère', 'Réptile marin', 'Réptile Volant', 'Autre');

if(isset($_POST['sendNewCrea'])){
 
    //Contrôle de la radio typeSelect
    if(!empty($_POST['typeSelect'])) {
        if(in_array($_POST['typeSelect'], $categories)) {
            $creatureModel->type = htmlspecialchars($_POST['typeSelect']);               
        }else {
            $formErrors['typeSelect'] = 'Merci de sélectionner un type de créature';
        }
    }else {
        $formErrors['typeSelect'] = 'Veuillez sélectionner un type de créature';
    }

    //Contrôle du Nom de la creature
    if(isset($_POST['creaName'])){
        if(preg_match($regexName, $_POST['creaName'])){
            $creatureModel->name = htmlspecialchars($_POST['creaName']);
        }else{
            $formErrors['creaName'] = 'Format Incorrect, 2 lettres minimum, aucun chiffre';
        }
    }else{
        $formErrors['creaName'] = 'Veuillez renseigner un nom pour la créature';
    }

    //Contrôle de l'ajout de fichier
    if(isset($_FILES['imageUpload'])) {
        $extensionUpload = pathinfo($_FILES['imageUpload']['name'], PATHINFO_EXTENSION); // recupere le nom du fichier
        //test si l'élement extention upload se trouve dans le tableau extention autorisées
        if(in_array(strtolower($extensionUpload), $extensionsWhiteList)){
            $imageUpload =  'Vous avez envoyé ' . $_FILES['imageUpload']['name'] . ' Il s\'agit d\'un fichier .' . $extensionUpload;
        }else{
            $formErrors['imageUpload'] = 'Les formats acceptés sont : ' . implode(', ', $extensionsWhiteList);
        }
    }else{
        $formErrors['imageUpload'] = 'Veuillez sélectionner un fichier';
    }

    ##### Contrôle des menus déroulants #####

    //Contrôle de la période
    if(!empty($_POST['period'])) {
        if(in_array($dinoPeriod[$_POST['period']], $dinoPeriod)) {
            $creatureModel->period = htmlspecialchars($_POST['period']);
        }else{
            $formErrors['period'] = 'Une erreur est survenue';
        }
    }else{
        $formErrors['period'] = 'Veuillez sélectionner une période';
    }

    //Contrôle de l'habitat
    if(!empty($_POST['habitat'])) {
        if(in_array($_POST['habitat'], $environmentArray)) {
            $environment = htmlspecialchars($_POST['habitat']);
        }else{
            $formErrors['habitat'] = 'Une erreur est survenue';
        }
    }else{
        $formErrors['habitat'] = 'Veuillez sélectionner un habitat';
    }

    //rechercher à l'index #######################################
    //Contrôle alimentation
    if(!empty($_POST['diet'])) {
        if(in_array($dinoType[$_POST['diet']], $dinoType)) {
            $creatureModel->diet = htmlspecialchars($_POST['diet']);
        }else{
            $formErrors['diet'] = 'Une erreur est survenue';
        }
    }else{
        $formErrors['diet'] = 'Veuillez sélectionner une alimentation';
    }

    ##### FIN GESTION MENUS DEROULANTS #####

    //Contrôle Paléonthologue
    if(isset($_POST['discoverer'])){
        if(preg_match($regexName, $_POST['discoverer'])){
            //Met la chaine de caracteres en minuscules
            $lowerCaseName = strtolower(htmlspecialchars($_POST['discoverer']));
            //Passe la 1ere lettre de chaque mot en Majuscule
            $creatureModel->discoverer = ucwords($lowerCaseName, ' ');
        }else{
            $formErrors['discoverer'] = 'Format Incorrect, 2 lettres minimum, aucun chiffre';
        }
    }else{
        $formErrors['discoverer'] = 'Veuillez renseigner un nom pour la créature';
    }

    //Contrôle de la description #####BUGGEE SUR LA VERIF DE LONGUEUR#######
    if(isset($_POST['description'])){
        if(strlen($_POST['description']) <= 5){
            $formErrors['description'] = 'Description trop courte, 500 caractères minimum (espaces inclus)';
        }else{
            $creatureModel->description = htmlspecialchars($_POST['description']);
        }
    }else{
        $formErrors['description'] = 'Veuillez renseigner une description';
    }

    if(empty($formErrors)){
        var_dump($creatureModel);
        $creatureModel->addCreatureSimple();
    }
}