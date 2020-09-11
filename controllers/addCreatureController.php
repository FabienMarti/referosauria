<?php
//Regex nom
$regexName = '%^[A-ÿ_\-\ ]{2,30}$%';

//Tableau des extensions de fichier autorisées
$fileExtension = array('jpg', 'png', 'bmp', 'jpeg');

//Tableau d'erreurs
$formErrors = array();

$creature = new creature();
//appel des méthodes
$showCreatureInfo = $creature->getSingleDinoInfo();
$showDiets = $creature->getCreaDiets();
$showCategories = $creature->getCreaCategories();
$showPeriods = $creature->getCreaPeriods();
$showDiscoverers = $creature->getCreaDiscoverers();
$showEnvironments = $creature->getCreaEnvironments();



//Tableaux menu déroulants
$environmentArray = array('Amérique du Nord', 'Amérique du Sud', 'Europe', 'Asie', 'Afrique', 'Océanie', 'Antartique' );

if(isset($_POST['sendNewCrea'])){

#########################################################################################

    //Contrôle de la radio category
    if(!empty($_POST['category'])) {
        $creature->type = intval(htmlspecialchars($_POST['category']));     
    }else {
        $formErrors['category'] = 'Veuillez sélectionner un type de créature';
    }

    //Contrôle du Nom de la creature
    if(isset($_POST['creaName'])){
        if(preg_match($regexName, $_POST['creaName'])){
            //vérifie si le dossier n'existe pas déjà
            if(!file_exists('../assets/img/creatures/' . strtolower(htmlspecialchars($_POST['creaName'])))){
                //passe le nouveau nom de dossier en minuscules pour éviter les doublons
                $minusCreaName = strtolower(htmlspecialchars($_POST['creaName']));
                //créé un nouveau dossier
                mkdir('../assets/img/creatures/' . $minusCreaName);
            }
            $creature->name = ucwords(htmlspecialchars($_POST['creaName']));
        }else{
            $formErrors['creaName'] = 'Format Incorrect, 2 lettres minimum, aucun chiffre';
        }
    }else{
        $formErrors['creaName'] = 'Veuillez renseigner un nom pour la créature';
    }

    //Contrôle de l'ajout de fichier Image principale
    if (!empty($_FILES['mainImageUpload']) && $_FILES['mainImageUpload']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['mainImageUpload']['name']);        
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = '../assets/img/creatures/' . strtolower(htmlspecialchars($_POST['creaName'])) . '/';
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = htmlspecialchars($_POST['creaName']) . 'ImagePrincipale' . '_' . $date;
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['mainImageUpload']['tmp_name'], $fileFullPath)) {
            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
            chmod($fileFullPath, 0644);
            $creature->mainImage = $fileFullPath;
          } else {
            $formErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
          }
        } else {
          $formErrors['file'] = 'Votre fichier n\'est pas du format attendu';
        }
      } else {
        $formErrors['file'] = 'Veuillez selectionner un fichier';
      }
    //Contrôle de l'ajout de fichier la mini image
    if (!empty($_FILES['miniImageUpload']) && $_FILES['miniImageUpload']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['miniImageUpload']['name']);
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array(strtolower($fileInfos['extension']), $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = '../assets/img/creatures/' . strtolower(htmlspecialchars($_POST['creaName'] . '/'));
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = htmlspecialchars($_POST['creaName']) . 'MiniImage' . '_' . $date;
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['miniImageUpload']['tmp_name'], $fileFullPath)) {
            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
            chmod($fileFullPath, 0644);
            $creature->miniImage = $fileFullPath;
          } else {
            $formErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
          }
        } else {
          $formErrors['file'] = 'Votre fichier n\'est pas du format attendu';
        }
      } else {
        $formErrors['file'] = 'Veuillez selectionner un fichier';
      }

    ##### Contrôle des menus déroulants #####

    //Contrôle de la période
    if(!empty($_POST['period'])) {
        $creature->period = intval(htmlspecialchars($_POST['period']));            
    }else{
        $formErrors['period'] = 'Veuillez sélectionner une période';
    }

    //Contrôle de l'habitat
    if(!empty($_POST['habitat'])) {
        $creature->environment = htmlspecialchars($_POST['habitat']);  
    }else{
        $formErrors['habitat'] = 'Veuillez sélectionner un habitat';
    }

    //rechercher à l'index #######################################
    //Contrôle alimentation
    #########################################################################################
    if(!empty($_POST['diet'])) {
        $creature->diet = intval(htmlspecialchars($_POST['diet']));
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
            $creature->discovery = ucwords($lowerCaseName, ' ');
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
            $creature->description = htmlspecialchars($_POST['description']);
        }
    }else{
        $formErrors['description'] = 'Veuillez renseigner une description';
    }

    if(empty($formErrors)){
        
        if($creature->checkCreatureExists() == 0){
            $messageSuccess = 'La créature à été ajoutée avec succès';
            $creature->addCreatureSimple();
        }else{
            $messageFail = 'La créature existe déjà !';
        }
    }else{
        $messageFail = 'Une erreur est survenue, contactez le service technique';
    }
}

