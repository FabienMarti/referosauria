<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
        <link href="<?= $linkModif ?>assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- On vérifie que la variable $pageTitle est définie sur la page en question, sinon on affiche 'Non-Défini' -->
        <title><?= isset($pageTitle) ? $pageTitle : 'Non-Défini' ?></title>
    </head>
<body>
<!-- Modale de connexion -->
    <div class="modal fade" id="modalConnection" tabindex="-1" role="dialog" aria-labelledby="modalConnectionTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><u>Se connecter</u></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body divBackColor">
                    <div id="connectionForm">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="usernameConnect">Nom d'utilisateur : </label>
                                <input type="text" id="usernameConnect" name="usernameConnect" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['usernameConnect']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_COOKIE['username']) ? 'value="' . $_COOKIE['username'] . '"' : '' ?> />
                                    <?php if (isset($formErrors['usernameConnect'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['usernameConnect'] ?></p>
                                    <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="passwordConnect">Mot de passe : </label>
                                <input type="password" id="passwordConnect" name="passwordConnect" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['passwordConnect']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                    <?php if (isset($formErrors['passwordConnect'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['passwordConnect'] ?></p>
                                    <?php } ?>
                                <a href="#" onclick="switchToForgottenPassword(connectionForm, forgottenPassword)">Mot de passe oublié ?</a>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="login" class="btn btn-primary" value="Connexion" />
                            </div>
                        </form>
                    </div>
                    <div id="forgottenPassword">
                        <form action="" method="POST">
                            <p>Veuillez saisir votre adresse e-mail ci-dessous. Nous vous enverrons les instructions pour créer un nouveau mot de passe.    </p>
                            <div class="form-group">
                                <label for="mailForgotten">Adresse mail :</label>
                                <input type="email" name="mailForgotten" id="mailForgotten" placeholder="Ex : Monmail@mail.com" class="form-control" />
                            </div>
                            <div class="form-group">
                                 <input type="submit" name="sendForgottenMail" value="Envoyer" class="form-control btn btn-primary" />
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<header class="container-fluid p-0 m-0">
<!-- Barre de Navigation -->
            <nav id="mainNav" class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand d-md-none titleStyleShadow">REFEROSAURIA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto text-center">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= $linkModif ?>index.php"><i class="fas fa-home"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= $linkModif ?>views/dinoList.php?page=1">Liste des dinosaures</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white" href="<?= $linkModif ?>views/discover.php">Découvrir</a>
                            </li>
                            <?php if(isset($_SESSION['profile'])){ ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link text-white" href="<?= $linkModif ?>views/addCreature.php">Ajouter une créature</a>
                            </li><?php } ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Jeux
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <a class="dropdown-item" href="<?= $linkModif ?>views/construction.php">Quiz</a>
                                    <a class="dropdown-item" href="<?= $linkModif ?>views/construction.php">Générateur de Dinom</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= $linkModif ?>views/construction.php">Forum</a>
                            </li>
                        </ul>
                        <div class="text-center my-auto text-white">
                    <h1 class="titleStyleShadow mx-5 text-center d-none d-md-block">REFEROSAURIA</h1>
                </div>
                <div class="my-auto text-center h-100"><?php
                    if(isset($_SESSION['profile'])){ ?>
                            <p class="h5 titleStyleShadow"><?= isset($_SESSION['profile']) ? 'Bienvenu ' . $_SESSION['profile']['username'] : ''?></p>
                            <a class="btn btn-primary" href="<?= $linkModif ?>views/profil.php?page=infos">Profil</a>
                            <a class="btn btn-primary" href="<?= $linkModif ?>index.php?action=disconnect">Déconnexion</a>
                    <?php
                    }else{
                        ?>
                        <a class="btn btn-primary" href="<?= $linkModif ?>views/registration.php">S'inscrire</a>
                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#modalConnection">Connexion</a>
                        <?php
                    }?>
                </div>
                </div>
            </nav>
        </header>