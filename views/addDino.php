<?php
include 'controllers/addDinoController.php';
include 'view/parts/functions.php';
generateBreadcrumb(array('index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<section class="container mt-2">
<!-- section Droite --> 
  <h2 class="text-center">Ajouter une Créature</h2>
  <div class="row">
    <div class="col text-right"><a href="index.php?content=addDino&addingType=simple" class="btn btn-primary">Ajout simple</a></div>
    <div class="col"><a href="index.php?content=addDino&addingType=advanced" class="btn btn-primary">Ajout avancé</a></div>
  </div>
  <form action="" method="POST" enctype="multipart/form-data" class="row">
    <div class="col-6" id="dinoData">
      <div class="form-group">
        <label for="dinosaur">Dinosaure : </label>
        <input class="col-2" type="radio" name="typeSelect" id="dinosaur" value="Dinosaure" />
        <label for="other">Autre : </label>
        <input class="col-2" type="radio" name="typeSelect" id="other" value="Autre" />
      </div>
      <div class="form-group">
        <label for="InputTitle">Nom : </label>
        <input type="email" class="form-control col" id="InputTitle" aria-describedby="emailHelp" placeholder="Nom de la Créature">
      </div>
      <div class="form-group">
        <label for="description">Description : </label>
        <textarea type="text" class="form-control col" rows="10" id="description" placeholder="Description de la créature"></textarea>
        <label for="source">Source : </label>
        <input type="text" class="form-control col" maxlength="50" name="source" id="source" />
        <label for="sourceLink">Lien de la source : </label>
        <input type="text" class="form-control col" maxlength="255" name="sourceLink" id="sourceLink" />
      </div>
      <div class="form-group">
        <label for="sectionImage">Image du dinosaure : </label>
        <input type="file" class="form-control-file" name="sectionImage" id="sectionImage" />
      </div>
    </div>
<!-- section Gauche --> 
    <div class="col-6" id="dinoPrecision">
      <label for="period">Choisissez une période</label>
      <select class="form-control col" name="period">
        <option value="" disabled selected>Selectionnez</option>
        <?php
        foreach ($dinoPeriod as $period) {
        ?><option value="<?= $period ?>"><?= $period ?></option><?php
                                                                      }
                                                                        ?>
      </select>
      <label for="period">Habitat</label>
      <select class="form-control col" name="period">
        <option value="" disabled selected>Selectionnez</option>
        <?php
        foreach ($environmentArray as $area) {
        ?><option value="<?= $area ?>"><?= $area ?></option><?php
                                                                      }
                                                                        ?>
      </select>
      <label for="diet">Choisissez l'alimentation : </label>
      <select class="form-control col" name="diet">
        <option value="" disabled selected>Selectionnez</option>
        <?php
        foreach ($dinoType as $type) {
        ?><option value="<?= $type ?>"><?= $type ?></option><?php
                                                                    }
                                                                      ?>
      </select>
      <div class="form-group">
        <label for="discoverer">Paléonthologue à l'origine de la découverte : </label>
        <input type="text" class="form-control" maxlength="50" name="discoverer" id="discoverer" />
        <!-- PASSER L'input en minuscules puis avant envoie dans le BDD passer avec une Majuscule au début de chaque mot -->
      </div>
    </div>
<!-- détails supplémentaires -->
    <?php 
    if (isset($_GET['addingType'])){
      if($_GET['addingType'] == 'advanced'){
        include 'views/addDinoAdvanced.php';
      }else{

      }
    }?>    
    <div class="row">
      <div class="form-group col">
        <button type="submit" class="btn btn-primary" name="previewDino">Prévisualisation</button>
      </div>
      <div class="form-group col">
        <button type="submit" class="btn btn-primary" name="sendForm">Submit</button>
      </div>
    </div>
  </form>


</section>