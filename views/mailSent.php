<?php
$pageTitle = 'Envoyer un mail';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../controllers/mailSentController.php';
include_once 'parts/header.php';

if(isset($_SESSION['profile'])){
 if(isset($messageSuccess)){ ?>
        <div class="alert alert-success" role="alert">
          <?= $messageSuccess ?>
        </div>
    <?php }

    if(isset($messageFail)){ ?>
        <div class="alert alert-danger" role="alert">
          <?= $messageFail ?>
        </div>
    <?php } ?>
<div class="container my-5 p-3 divBackColor">
<h2 class="creaName text-center">Envoi mail :</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="mail">Email : </label>
            <input type="email" name="mail" id="mail" class="form-control" />
        </div>
        <p class="text-danger"><?= isset($formErrors['mail']) ? $formErrors['mail'] : '' ?></p>
        <div class="form-group">
            <label for="subject">Sujet : </label>
            <input type="text" name="subject" id="subject" class="form-control" />
        </div>
        <p class="text-danger"><?= isset($formErrors['subject']) ? $formErrors['subject'] : '' ?></p>
        <div class="form-group">
            <label for="message">Message : </label>
            <textarea type="text" name="message" id="message" class="form-control" rows="10" ></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="sendMail" value="Envoyer" class="btn btn-primary" />
        </div>
    </form>
</div>
<?php } else { 
    include 'parts/redirect.php';
 } ?> 
<?php include 'parts/footer.php' ?>