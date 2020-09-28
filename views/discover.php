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
        <li class="nav-item navButton">
          <a class="nav-link" id="first" onclick="changeCategory(0, this)">La Paléonthologie</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(1, this)">Les Dinosaures</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(2, this)">Créatures Océaniques</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(3, this)">Réptiles Volants</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(4, this)">Les Insectes</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(5, this)">Les Grandes Extinctions</a>
        </li>
        <li class="nav-item navButton">
          <a class="nav-link" onclick="changeCategory(6, this)">La Terre d'une autre époque</a>
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
  <section id="oceanCreatures" class="container-fluid mx-2 mb-5">
    <?php include 'parts/oceanicCreatures.php'; ?>
  </section>
<!-- Réptiles Volants -->
  <section id="flyingReptiles" class="container-fluid mx-2 mb-5">
    <?php include 'parts/flyingReptiles.php'; ?>
  </section>
<!-- Les Insectes -->
  <section id="bugs" class="container-fluid mx-2 mb-5">
    <?php include 'parts/bugs.php'; ?>
  </section>
<!-- Les Grandes Extinctions -->
  <section id="extinctions" class="container-fluid mx-2 mb-5">
    <?php include 'parts/extinctions.php'; ?>
  </section>
<!-- La Terre d'une autre époque -->
  <section id="anotherWorld" class="container-fluid mx-2 mb-5">
    <?php include 'parts/anotherWorld.php'; ?>
  </section>
<script>

//stocka toutes les sections dans un array
var allSections = document.getElementsByTagName('section');
var allButtons = document.getElementsByClassName('navButton');

changeCategory(0, first);

//fonction pour switcher de categories au clique
function changeCategory(category, input){
    for (let index = 0; index < allButtons.length; index++) {
        allButtons[index].style.border = 'none';
    }
//boucle pour cacher les catégories à l'appel de la fonction , i commence à 1 pour afficher 0 au chargement de la page
    for (let i = 0; i < allSections.length; i++) {
      
        if(category == i){
            input.parentNode.style.border = '3px solid black';
            allSections[i].style.display = 'block';
        }else{
            allSections[i].style.display = 'none';
        }
    }
}
</script>

<?php include 'parts/footer.php' ?>