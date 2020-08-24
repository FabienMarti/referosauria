<?php
//Regex nom
$regexName = '%^[A-ÿ_\-\ ]{2,30}$%';

//Tableau des extensions de fichier autorisées
$extensionsWhiteList = array('jpg', 'png');

//Tableau d'erreurs
$formErrors = array();

//Tableaux menu déroulants
$dinoPeriod = array('Trias inférieur', 'Trias moyen', 'Trias supérieur', 'Jurassique inférieur', 'Jurassique moyen', 'Jurassique supérieur', 'Crétacé inférieur', 'Crétacé supérieur');
$dinoType = array('Carnivore', 'Herbivore', 'Piscivore');
$environmentArray = array('Amérique du Nord', 'Amérique du Sud', 'Europe', 'Asie', 'Afrique', 'Océanie', 'Antartique' );
$categories = array('Dinosaure', 'Mammifère', 'Réptile marin', 'Réptile Volant', 'Autre');

if(isset($_POST['sendNewCrea'])){
 

        //Contrôle de la radio typeSelect
        if(!empty($_POST['typeSelect'])) {
            if(in_array($_POST['typeSelect'], $categories)) {
                $typeSelect = htmlspecialchars($_POST['typeSelect']);               
            }else {
                $formErrors['typeSelect'] = 'Merci de sélectionner un type de créature';
            }
        }else {
            $formErrors['typeSelect'] = 'Veuillez sélectionner un type de créature';
        }

        //Contrôle du Nom de la creature
        if(isset($_POST['creaName'])){
            if(preg_match($regexName, $_POST['creaName'])){
                $creaName = htmlspecialchars($_POST['creaName']);
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
        if(!empty($_REQUEST['period'])) {
            if(in_array($_REQUEST['period'], $dinoPeriod)) {
                $period = htmlspecialchars($_REQUEST['period']);
            }else{
                $formErrors['period'] = 'Une erreur est survenue';
            }
        }else{
            $formErrors['period'] = 'Veuillez sélectionner une période';
        }

        //Contrôle de l'habitat
        if(!empty($_REQUEST['habitat'])) {
            if(in_array($_REQUEST['habitat'], $environmentArray)) {
                $habitat = htmlspecialchars($_REQUEST['habitat']);
            }else{
                $formErrors['habitat'] = 'Une erreur est survenue';
            }
        }else{
            $formErrors['habitat'] = 'Veuillez sélectionner un habitat';
        }

        //Contrôle alimentation
        if(!empty($_REQUEST['diet'])) {
            if(in_array($_REQUEST['diet'], $dinoType)) {
                $diet = htmlspecialchars($_REQUEST['diet']);
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
                $discoverer = ucwords($lowerCaseName, ' ');
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
                $description = htmlspecialchars($_POST['description']);
            }
        }else{
            $formErrors['description'] = 'Veuillez renseigner une description';
        }






























    

































}