<?php 
include 'models/userModel.php';
include 'controllers/profilController.php' ?>
<div class="container">
    <div class="row mt-5 justify-content-around">
        <!-- Sommaire de gauche -->
        <nav id="profilNav" class="col-3 border border-dark">
            <p class="text-center h4">Bonjour <?= $showLightUserInfo->username ?></p>
            <p>Vous êtes inscrits depuis le : </br><?= $showLightUserInfo->inscDate ?></p>
            <ul class="p-2">
                <li><a href="index.php?content=profil&profilContent=infos">Mes informations</a></li>
                <li><a href="index.php?content=profil&profilContent=editPW">Changer le mot de passe</a></li>
                <li><a href="#">Mes derniers posts</a></li>
                <li><a href="#"></a></li>
                <li><a href="views/logout.php" class="btn btn-danger">Déconnexion</a></li>
            </ul>
        </nav>
        <!-- Contenu changeant en fonction du menu selectionné -->
        <section class="col-8 border border-dark p-5">
            <?php include $profilContent ?>
        </section>
    </div>
</div>