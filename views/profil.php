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
                <?php 
                    if(in_array($_SESSION['role'],$roles)){
                        foreach ($profilOptions as $link => $title) {
                            switch ($title) {
                                case 'Déconnexion':
                                    ?><li><a href="<?= $link ?>" class="btn btn-danger"><?= $title ?></a></li><?php
                                break;
                                case 'Supprimer le compte':
                                    ?><li><a href="<?= $link ?>" class="text-danger"><?= $title ?></a></li><?php
                                break;
                                default:
                                ?><li><a href="<?= $link ?>"><?= $title ?></a></li><?php }   
                            }
                    }else{
                        ?><p class="text-danger">Votre rôle est inexistant !</p><?php
                    }
                ?>
            </ul>
        </nav>
        <!-- Contenu changeant en fonction du menu selectionné -->
        <section class="col-8 border border-dark p-5">
            <?php include $profilContent ?>
        </section>
    </div>
</div>