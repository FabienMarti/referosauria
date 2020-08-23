<?php
$regexName = '%^[A-ÿ0-9_\-]{2,30}$%';

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



































    }

































}