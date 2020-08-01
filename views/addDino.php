<?php 
  include 'view/parts/functions.php'; 
  generateBreadcrumb(array('index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<main class="container mt-2">
    <h2 class="text-center">Ajouter une Créature</h2>
    <div class="row">
      <div class="col text-right"><a href="index.php?content=addDino&addingType=simple" class="btn btn-primary">Ajout simple</a></div>
      <div class="col"><a href="index.php?content=addDino&addingType=advanced" class="btn btn-primary">Ajout avancé</a></div>
      
    </div>
    <form>
    <label for="dinosaur">Dinosaure : </label>
    <input type="radio" name="typeSelect" id="dinosaur" value="Dinosaure" />
    <label for="other">Autre : </label>
    <input type="radio" name="typeSelect" id="other" value="Autre" />
        <div class="form-group">
          <label for="InputTitle">Nom de la créature</label>
          <input type="email" class="form-control col-md-4" id="InputTitle" aria-describedby="emailHelp" placeholder="Nom de la Créature">
        </div>
        <div class="form-group">
          <label for="description">Password</label>
          <textarea type="text" class="form-control col-md-6" rows="10" id="description" placeholder="Description de la créature" ></textarea>
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <input type="radio" aria-label="Radio button for following text input">
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with radio button">
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</main>