<?php
$regexName = '%^[A-ÿ0-9_\-]{2,30}$%';
$extensionsWhiteList = array('jpg', 'png');

$formErrors = array();

if(isset($_POST['sendNewCrea'])){
    if(!empty($_POST)){

        //controle de la radio typeSelect


        //controle du Nom de la creature
        if(isset($_POST['creaName'])){
            if(preg_match($regexName, $_POST['creaName'])){
                $creaName = htmlspecialchars($_POST['creaName']);
            }else{
                $formErrors['creaName'] = 'Format Incorrect, commencez par une majuscule';
            }
        }else{
            $formErrors['creaName'] = 'Veuillez renseigner un nom pour la créature';
        }

        //Ajout Fichier
        if (isset($_FILES['imageUpload'])) {
            $extensionUpload = pathinfo($_FILES['imageUpload']['name'], PATHINFO_EXTENSION); // recupere le nom du fichier
            //test si l'élement extention upload se trouve dans le tableau extention autorisées
            if (in_array(strtolower($extensionUpload), $extensionsWhiteList)){
                $imageUpload =  'Vous avez envoyer ' . $_FILES['imageUpload']['name'] . ' Il s\'agit d\'un fichier .' . $extensionUpload;
            }else {
                $formError['imageUpload'] = 'Les formats acceptés sont : ' . implode(', ', $extensionsWhiteList);
            }
        }else {
            $formError['imageUpload'] = 'Veuillez sélectioner un fichier';
        }

































    }

































}