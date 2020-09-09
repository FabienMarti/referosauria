<?php
    $formErrors = array();
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    $comment = new comment();
    $showEnvironments = $creature->getCreaEnvironments();

    if(!empty($_GET['id'])){
        $creature->id = htmlspecialchars($_GET['id']);

        if($creature->checkCreatureExistsById()){
            //récupère l'id de la créature en question
            //récupère le contenu ma methode getSingleDinoInfo() dans une variable
            $showCreatureInfo = $creature->getSingleDinoInfo();
            //stock l'ID de la période dans l'objet créature
            $creature->period = $showCreatureInfo->period;
            //va chercher les créatures de la même période
            $showCreaturesByPeriod = $creature->getCreaturesByPeriod();
            //Hydrate l'id d'user dans l'objet comment
            $comment->creaId = htmlspecialchars($_GET['id']);
        }else{
            header('Location: dinoList.php?page=1');
            exit;
        }
    }else{
       header('Location: dinoList.php?page=1');
       exit;
    }

    $areaMap = 0;
    foreach ($showEnvironments as $env) {
        if($showCreatureInfo->envId == $env->id){
            $areaMap =  $env->id;
        }
    }

    if(isset($_POST['sendComment'])){
        
        if(empty($_POST['comment'])){
            $formErrors['comment'] = 'Si vous voulez envoyer un commentaire, veuillez en renseigner un.';
        }

        if(empty($formErrors)){
            if(isset($_SESSION['profile'])){
            $comment->content = htmlspecialchars($_POST['comment']);
            $comment->userId = $_SESSION['profile']['id'];
            $comment->addCommentOnCreature();
            }
        }
    }
    $showCreaComments = $comment->getAllCommentsByCreaId();
/*cas des INT dans recherche : on doit envoyer un tableau de tableaux ou tableau d'objet a la place d'un simple tableau
$tableau['champSQL'][type de données]   exemple ['type']ex: STR   || ['logical']ex: OR   ||  ['value']ex: 'toto' on utilise plus d'implode() */