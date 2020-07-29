<?php 
    $pageTitle = 'Découvrir';
    include 'views/parts/header.php';
    include 'views/parts/functions.php';
    generateBreadcrumb(array('index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<main class="container-fluid">
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
<section id="paleonthology">
  <div style="height: 100vh" class="bg bg-danger"></div>
</section>
<!-- Les Dinosaures -->
<section id="dinosaurs">
<div style="height: 100vh" class="bg bg-success"></div>
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
</main>
<script>
  //stockage de toutes les sections dans un array
  var allSections = document.getElementsByTagName("section");
  //appel de la fonction au chargement de la page, par défaut la 1ere catégorie est affichée
  changeCategory();
  //fonction pour switcher de categories au clique
  function changeCategory(category){
    //boucle pour cacher les catégories à l'appel de la fonction
    for (let i = 0; i < allSections.length; i++) {
          allSections[i].style.display = 'none';
    }
    switch (category) {
      case 0:
        allSections[0].style.display = 'block';
      break;
      case 1:
        allSections[1].style.display = 'block';
      break;
      case 2:
        allSections[2].style.display = 'block';
      break;
      case 3:
        allSections[3].style.display = 'block';
      break;
      case 4:
        allSections[4].style.display = 'block';
      break;
      case 5:
        allSections[5].style.display = 'block';
      break;
      case 6:
        allSections[6].style.display = 'block';
      break;
      default:
        allSections[0].style.display = 'block';
      break;
    }
  }
</script>
<?php include 'views/parts/footer.php'; ?>