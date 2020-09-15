<?php
    $formErrors = array();
    //je créé une nouvelle instance de la classe 'creature'
    $creature = new creature();
    $comment = new comment();
    $showEnvironments = $creature->getCreaEnvironments();

    if(isset($_SESSION['profile'])){
        $comment->userId = $_SESSION['profile']['id'];
    }
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
    //Boucle pour définir la carte à afficher en fonction de l'id de l'environnement
    foreach ($showEnvironments as $env) {
        
        if($showCreatureInfo->envId == $env->id){
            $areaMap =  $env->id;
        }
    }

    if(isset($_POST['sendComment'])){

        //Récupère le datetime du dernier commentaire ajouté par l'utilisateur en question et sur la creature en question.
        $lastComDateHour = new DateTime($comment->lastCommentDateInsertById());  
        //Récupère le datetime actuel. 
        $date = new DateTime();
        //Calcul la différence entre la date d'ajout et la l'heure actuelle.
        $interval = $lastComDateHour->diff($date);
        //Affiche le resultat sous forme de minutes.
        $intervalResult = $interval->format('%i');
        //Affiche le resultat sous forme de secondes.
        $intervalResultSeconds = $interval->format('%s');
        //Calcul le temps restant en secondes.
        $timeLeft = 60 - $intervalResultSeconds;

        if(!empty($_POST['comment'])){
            //Vérifie si l'utilisateur à bien attendu 1 minute pour renvoyer une commentaire.
            if($comment->checkCommentExistsById() > 0){
                if($intervalResult > 1){
                    $comment->content = htmlspecialchars($_POST['comment']);
                }else{
                    $formErrors['comment'] = 'Vous devez attendre ' . $timeLeft . ' secondes avant de pouvoir poster un nouveau commentaire.';
                }
            }else{
                $formErrors['comment'] = 'Si vous voulez envoyer un commentaire, veuillez en renseigner un.';
            }
        }else{
            $formErrors['comment'] = 'Si vous voulez envoyer un commentaire, veuillez en renseigner un.';
        }

        if(empty($formErrors)){

            if(isset($_SESSION['profile'])){
                $comment->addCommentOnCreature();
            }
        }
    }

    if($comment->checkCommentExistsById() >= 1){
        $showCreaComments = $comment->getAllCommentsByCreaId();
    }
/*cas des INT dans recherche : on doit envoyer un tableau de tableaux ou tableau d'objet a la place d'un simple tableau
$tableau['champSQL'][type de données]   exemple ['type']ex: STR   || ['logical']ex: OR   ||  ['value']ex: 'toto' on utilise plus d'implode() */