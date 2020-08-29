<?php 
    session_start();
    $_SESSION['isConnected'] = true;
    //Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
    $_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link href="<?= $linkModif ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- On vérifie que la variable $pageTitle est définie sur la page en question, sinon on affiche 'Non-Défini' -->
        <title><?= isset($pageTitle) ? $pageTitle : 'Non-Défini' ?></title>
    </head>
<body>
<header class="container-fluid p-0 m-0">
        <!-- BG + Titre -->
        <div id="headerBG" class="row m-0">
            <div class="col-md-4 offset-md-4 text-center my-auto text-white">
                <h1 class="mainTitle titleStyle">REFEROSAURIA</h1>
            </div>
            <div class="col-md-2 offset-md-2 my-auto text-center border border-danger h-100 "><?php
                if($_SESSION['isConnected'] == true){
                    ?>
                    <div class="row">
                    <img class="img-fluid col-4" src="<?= $linkModif ?>assets/img/profilPictures/member.png" width="100px" height="100px" />
                    <div class="col-8 text-white"><p>Bonjour NOMDUTILISATEUR</p></div>
                    


                    <a class="btn col-6" href="<?= $linkModif ?>views/profil.php">Profil</a>
                    <a class="btn col-6" href="<?= $linkModif ?>views/logout.php">Déconnexion</a>
                    </div>
                    
                    
                    
                    <?php
                }else{
                    ?><a class="btn" href="<?= $linkModif ?>views/registration.php">S'inscrire</a>
                    <a class="btn" data-toggle="modal" data-target="#exampleModalCenter">Connexion</a><?php
                }?>
            </div>
        </div>
<!--NavBar-->
            <nav id="mainNav" class="navbar navbar-expand-md">
                <a class="navbar-brand d-md-none" href="#">Menu</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= $linkModif ?>index.php"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= $linkModif ?>views/dinoList.php">Liste des dinosaures</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="<?= $linkModif ?>views/discover.php">Découvrir</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Contribuer
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="<?= $linkModif ?>views/addCreature.php">Déposer un article</a>
                                <a class="dropdown-item" href="<?= $linkModif ?>views/contribute">Faire un don</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jeux
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                <a class="dropdown-item" href="<?= $linkModif ?>views/quiz.php">Quiz</a>
                                <a class="dropdown-item" href="#">Générateur de Dinom</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  text-white" href="<?= $linkModif ?>views/forum.php">Forum</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="<?= $linkModif ?>views/dinoList.php" method="GET">
                        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search" />
                        <button class="btn btn-outline-success my-2 my-sm-0" type="sendSearch">Rechercher</button>
                    </form>
                </div>
            </nav>
        </header>