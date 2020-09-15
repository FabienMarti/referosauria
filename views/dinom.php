<?php 
$pageTitle = 'Générateur de Dinom';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';    
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<section class="container-fluid p-0">
    <form action="" method="POST">
        





    </form>
</section>
<?php include 'parts/footer.php' ?>