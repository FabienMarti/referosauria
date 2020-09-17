<?php 
$pageTitle = 'En construction';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../lang/FR_FR.php';
include_once '../controllers/connectionController.php';
include 'parts/header.php';
?>
<main>
    <section>
        <div class="container divBackColor text-center p-3 my-5">
            <h1>Page en cours de construction</h1>
            <a href="<?= $linkModif ?>index.php" class="btn btn-primary mb-3">Retour accueil</a>
            <img src="../assets/img/construct.png" alt="Working dino" title="Tyrannosaurus au travail" class="img-fluid" />
        </div>
    </section>  
</main>
<?php include 'parts/footer.php' ?>