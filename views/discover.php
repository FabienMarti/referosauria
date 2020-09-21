<?php 
$pageTitle = 'Découvrir';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/connectionController.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';    
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<!-- Menu Nav local -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand d-md-none" href="#">Découvrir</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(0)">La Paléonthologie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(1)">Les Dinosaures</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(2)">Créatures Océaniques</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(3)">Réptiles Volants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(4)">Les Insectes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(5)">Les Grandes Extinctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="changeCategory(6)">La Terre d'une autre époque</a>
        </li>
      </ul>
    </div>
  </nav>
<!-- La Paléonthologie -->
  <section id="paleonthology" class="container-fluid mx-2 mb-5">
    <?php include 'parts/paleonthology.php' ?>
  </section>
<!-- Les Dinosaures -->
  <section id="dinosaurs" class="container-fluid mx-2 mb-5">
    <?php include 'parts/dinosaurs.php'; ?>
  </section>
<!-- Créatures Océaniques -->
  <section id="oceanCreatures">
  <div style="height: 100vh" class="bg bg-primary"></div>
  </section>
<!-- Réptiles Volants -->
  <section id="flyingReptiles">
  <div style="height: 100vh" class="bg bg-secondary"></div>
  </section>
<!-- Les Insectes -->
  <section id="bugs">
  <div style="height: 100vh" class="bg bg-warning"></div>
  </section>
<!-- Les Grandes Extinctions -->
  <section id="extinctions">
  <div style="height: 100vh" class="bg bg-info"></div>
  </section>
<!-- La Terre d'une autre époque -->
  <section id="anotherWorld">
  <div style="height: 100vh" class="bg bg-danger"></div>
  </section>
<script>
//stockage de toutes les sections dans un array
var allSections = document.getElementsByTagName("section");
  changeCategory(0);
//fonction pour switcher de categories au clique
function changeCategory(category){
//boucle pour cacher les catégories à l'appel de la fonction , i commence à 1 pour afficher 0 au chargement de la page
    for (let i = 0; i < allSections.length; i++) {

        if(category == i){
            allSections[i].style.display = 'block';
        }else{
            allSections[i].style.display = 'none';
        }
    }
}
</script>

<?php include 'parts/footer.php' ?>