<?php
//Regex nom
$regexName = '%^[A-ÿ_\-\ ]{2,30}$%';

//Tableau des extensions de fichier autorisées
$fileExtension = array('jpg', 'png');

//Tableau d'erreurs
$formErrors = array();

$creature = new creature();
//appel des méthodes
$showCreatureInfo = $creature->getSingleDinoInfo();
$showDiets = $creature->getDiets();
$showCategories = $creature->getCategories();
$showPeriods = $creature->getPeriod();
$showDiscoverers = $creature->getDiscoverer();



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
            $creature->name = htmlspecialchars($_POST['creaName']);
        }else{
            $formErrors['creaName'] = 'Format Incorrect, 2 lettres minimum, aucun chiffre';
        }
    }else{
        $formErrors['creaName'] = 'Veuillez renseigner un nom pour la créature';
    }

    //Contrôle de l'ajout de fichier
    if (!empty($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['imageUpload']['name']);
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array($fileInfos['extension'], $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = '../uploads/';
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = htmlspecialchars($_POST['creaName']) . '_' . $date;
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['imageUpload']['tmp_name'], $fileFullPath)) {
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


    ##### Contrôle des menus déroulants #####
    #########################################################################################
    //Contrôle de la période
    if(!empty($_POST['period'])) {
     
                $creature->period = intval(htmlspecialchars($_POST['period']));            
          
    }else{
        $formErrors['period'] = 'Veuillez sélectionner une période';
    }

    //Contrôle de l'habitat
    if(!empty($_POST['habitat'])) {
        if(in_array($_POST['habitat'], $environmentArray)) {
            $creature->environment = htmlspecialchars($_POST['habitat']);
        }else{
            $formErrors['habitat'] = 'Une erreur est survenue';
        }
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
        
        $creature->date = date('Y-m-d');
        $creature->addCreatureSimple();
        var_dump($creature->addCreatureSimple());
        var_dump($creature);
    }
}