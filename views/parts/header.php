<?php 
    session_start();
    //Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
    $_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
    include_once $linkModif . 'config.php';
    include $linkModif . 'lang/FR_FR.php';
    //Gestion des actions
if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        //Pour deconnecter l'utilisateur on détruit sa session
        session_destroy();
        //Et on le redirige vers l'accueil
        header('location:index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
        <link href="<?= $linkModif ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- On vérifie que la variable $pageTitle est définie sur la page en question, sinon on affiche 'Non-Défini' -->
        <title><?= isset($pageTitle) ? $pageTitle : 'Non-Défini' ?></title>
    </head>
<body>
<header class="container-fluid p-0 m-0">
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
                            <a class="nav-link text-white" href="<?= $linkModif ?>views/dinoList.php?page=1">Liste des dinosaures</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="<?= $linkModif ?>views/discover.php">Découvrir</a>
                        </li>
                        <li class="nav-item dropdown">
                        <a class="nav-link text-white" href="<?= $linkModif ?>views/addCreature.php">Ajouter une créature</a>
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
                    <div class="text-center my-auto text-white">
                <h1 class="mainTitle titleStyle text-center">REFEROSAURIA</h1>
            </div>
            <div class="my-auto text-center border border-danger h-100 "><?php
                if(isset($_SESSION['profile'])){
                    ?>
                        <p class="h5"><?= isset($_SESSION['profile']['username']) ? 'Bienvenue ' . $_SESSION['profile']['username'] : ''?></p>
                        <a class="btn" href="<?= $linkModif ?>views/profil.php?id=<?= $_SESSION['profile']['id'] ?>">Profil</a>
                        <a class="btn" href="<?= $linkModif ?>index.php?action=disconnect">Déconnexion</a>
                   <?php
                }else{
                    ?>
                    <a class="btn" href="<?= $linkModif ?>views/registration.php">S'inscrire</a>
                    <a class="btn" data-toggle="modal" data-target="#exampleModalCenter">Connexion</a>
                    <?php
                }?>
            </div>
                </div>
            </nav>
            <h1 class="divBackColor"><?= isset($_SESSION['profile']['username']) ? 'Bienvenue ' . $_SESSION['profile']['username'] : ''?></h1>
        </header>