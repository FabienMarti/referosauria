<?php
$pageTitle = 'Changer de mot de passe';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../controllers/connectionController.php';
include_once 'parts/header.php';
?>
<div class="container my-5 p-3 divBackColor">
<h2 class="creaName text-center">Changez votre mot de passe : </h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" id="password" class="form-control" />
        </div>
        <div class="form-group">
            <label for="passwordVerify">Confirmer le mot de passe : </label>
            <input type="password" name="passwordVerify" id="passwordVerify" class="form-control" />
        </div>
        <div class="form-group">
            <input type="submit" name="sendPassword" value="Confirmer" class="form-group btn" />
        </div>
    </form>
</div>
<?php include 'parts/footer.php' ?>