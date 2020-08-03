<?php
$dinoPeriod = array('Trias', 'Jurassique', 'Crétacé');
$dinoType = array('Carnivore', 'Herbivore');
$discoverers = array();

    if(isset($_GET['sendFilter'])){
        if(!empty($_GET['period'])){
            $period = htmlspecialchars($_GET['period']);
        }else{
            
        }

        if(!empty($_GET['diet'])){
            $diet = htmlspecialchars($_GET['diet']);
        }else{

        }
    }

    