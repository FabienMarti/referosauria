<?php include 'controllers/indexController.php' ?>
<!DOCTYPE html>
<html lang="FR" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
        <link href="assets/css/index.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/header.css" rel="stylesheet" type="text/css" />
        <!-- On vérifie que la variable $pageTitle est définie sur la page en question, sinon on affiche 'Non-Défini' -->
        <title><?= isset($pageTitle) ? $pageTitle : 'Non-Défini' ?></title>
    </head>
<body>
<header class="container-fluid p-0 m-0">
        <!--BG + Titre + Vignette profil-->
        <div id="headerBG" class="row">
            <div class="col-md-4 offset-md-4 text-center my-auto text-white">
                <h1>REFEROSAURIA</h1>
            </div>
            <div class="col-md-2 offset-md-2 my-auto text-center">
                <a href="index.php?content=registration" class="text-white"><button class="btn btn-primary">S'inscrire</button></a>
            </div>
        </div>
<!--NavBar-->
            <nav class="navbar navbar-expand-md">
                <a class="navbar-brand d-md-none" href="#">Menu</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?content=home"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?content=dinoList">Liste des dinosaures</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="index.php?content=discover">Découvrir</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Contribuer
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="index.php?content=addDino">Déposer un article</a>
                                <a class="dropdown-item" href="index.php?content=contribute">Faire un don</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Jeux
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                <a class="dropdown-item" href="index.php?content=quiz">Quiz</a>
                                <a class="dropdown-item" href="#">Générateur de Dinom</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?content=forum">Forum</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Go</button>
                    </form>
                </div>
            </nav>
        </header>
<main class="">
    <?php include $content ?>
</main>
<!-- Modale footer -->
    <div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="footerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="footerModalLabel">Titre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Politique de confidentialité -->
                <div class="modalContent" id="privacyPolicy">
                    <p>1</p>
                </div>
                <!-- Conditions Générales -->
                <div class="modalContent" id="conditions">
                    <p>2</p>
                </div>
                <!-- Accessibilité -->
                <div class="modalContent" id="accessibility">
                    <p>3</p>
                </div>
                <!-- À propos de referosauria -->
                <div class="modalContent" id="about">
                    <p>4</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>   
<!-- Footer -->
    <footer class="container-fluid mt-5 text-white">
        <div class="row text-white">
            <p class="col-md-2">© <?= date('Y') ?> Referosauria</p>
            <div class="offset-md-2 col-md-8 text-right">
                <div class="row">
                    <p class="col-md-3"><a onclick="changeFooterModalContent(0)">Politique de confidentialité</a></p>
                    <p class="col-md-3"><a onclick="changeFooterModalContent(1)">Conditions générales</a></p>
                    <p class="col-md-3"><a onclick="changeFooterModalContent(2)">Accessibilité</a></p>
                    <p class="col-md-3"><a onclick="changeFooterModalContent(3)">À propos de referosauria</a></p>
                </div>
            </div>
        </div>
    </footer>
<!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="assets/js/footer.js"></script>
</body>
</html>