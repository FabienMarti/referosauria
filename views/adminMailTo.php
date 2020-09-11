<?php 
$pageTitle = 'Envoyer un mail';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/connectionController.php';
include_once '../lang/FR_FR.php';
include '../controllers/adminMailToController.php';
include 'parts/header.php';
?>
<?php 
    if(isset($_SESSION['profile']) && $_SESSION['profile']['roleId'] == 1){ ?>
<div class="container divBackColor rounded my-5 p-5">
    <h1 class="text-center">Envoyer un email à <?= $showUser->username ?></h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="mail">Email : </label>
            <input type="email" name="mail" id="mail" class="form-control" value="<?= $showUser->mail ?>" disabled />
        </div>
        <div class="form-group">
            <label for="subject">Objet : </label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="" value="Sujet : " />
        </div>
        <div class="form-group">
            <label for="message">Message : </label>
            <textarea name="message" id="message" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="sendMail" id="sendMail" class="form-control btn btn-primary" />
        </div>
    </form>
</div>
    <?php } else { ?>
        <?php include 'parts/redirect.php' ?> 
   <?php } ?>
<?php include 'parts/footer.php' ?>