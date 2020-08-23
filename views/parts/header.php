<?php 
    session_start();
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
        <link href="<?= $linkModif ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- On vérifie que la variable $pageTitle est définie sur la page en question, sinon on affiche 'Non-Défini' -->
        <title><?= isset($pageTitle) ? $pageTitle : 'Non-Défini' ?></title>
    </head>
<body>
<header class="container-fluid p-0 m-0">
        <!-- BG + Titre -->
        <div id="headerBG" class="row m-0">
            <div class="col-md-4 offset-md-4 text-center my-auto text-white">
                <h1>REFEROSAURIA</h1>
            </div>
            <div class="col-md-2 offset-md-2 my-auto text-center"><?php
                if($_SESSION['isConnected'] == true){
                    ?><a class="btn btn-primary" href="<?= $linkModif ?>profil.php">Profil</a>
                    <a class="btn btn-primary" href="<?= $linkModif ?>views/logout.php">Déconnexion</a><?php
                }else{
                    ?><a class="btn btn-primary text-white" href="<?= $linkModif ?>registration.php">S'inscrire</a>
                    <a class="btn btn-primary text-white" data-toggle="modal" data-target="#exampleModalCenter">Connexion</a><?php
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
                                <a class="dropdown-item" href="<?= $linkModif ?>views/addDino.php">Déposer un article</a>
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
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Go</button>
                    </form>
                </div>
            </nav>
        </header>