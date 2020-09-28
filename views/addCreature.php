<?php 
$pageTitle = 'Ajout créature';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../models/creatureModel.php';
include '../controllers/addCreatureController.php';
include '../controllers/breadcrumb.php';
include '../controllers/connectionController.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));

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
<div class="container-fluid border border-dark rounded pt-2 px-md-5 my-5 divBackColor">
    <h2 class="titleStyle text-center">Ajouter une créature</h2>
    <form action="" method="POST" enctype="multipart/form-data">
<!-- Selection catégorie -->
            <p>Sélectionnez un type de créature : </p>
            <div class="form-group row justify-content-between">
                <?php 
                    foreach ($showCategories as $category) { ?>
                        <div class="col-12 col-md">
                            <label class="my-auto" for="<? $category->name ?>"><?= $category->name ?> : </label>
                            <input type="radio" name="category" id="<?= $category->id ?>" value="<?= $category->id ?>" <?= isset($_POST['category']) && $_POST['category'] == $category->id ? 'checked' : '' ?> class="my-auto <?= isset($formErrors['category']) ? 'is-invalid' : (isset($category) ? 'is-valid' : '') ?>" />
                        </div><?php } 
                    if (isset($formErrors['category'])) { ?>
                            <div class="text-danger d-block"><?= $formErrors['category'] ?></div>
                        <?php } ?>
            </div>
<!-- Nom de la créature -->
        <div class="row">
            <div class="form-group col-md-12 <?= count($_POST) > 0 ? (isset($formErrors['creaName']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for="creaName">Nom : </label>
                    <input type="text" id="creaName" name="creaName" placeholder="Nom de la Créature" class="form-control <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['creaName']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['creaName']) ? 'value="' . $_POST['creaName'] . '"' : '' ?> />
            <?php if (isset($formErrors['creaName'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['creaName'] ?></p>
            <?php } ?>
            </div>
<!-- Image principale de la créature FILE -->
            <div class="col-md-4 text-center">
                <img id="img1" class="imgPreview" src="http://placehold.it/180" alt="Image" />
                <div class="form-group  <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for="mainImageUpload">Image principale de la créature : </label>
                    <input onchange="readURL1(this)" type="file" name="mainImageUpload" id="mainImageUpload" class="form-control-file <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                    <?php if (isset($formErrors['mainImageUpload'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['mainImageUpload'] ?></p>
                    <?php } ?>
                </div>
            </div>
<!-- Mini image de la créature FILE -->
            <div class="col-md-4 text-center">
                <img id="img2" class="imgPreview" src="http://placehold.it/180" alt="Image" />
                <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['miniImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for="miniImageUpload">Image de tête de la créature : </label>
                    <input onchange="readURL2(this)" type="file" name="miniImageUpload" id="miniImageUpload" class="form-control-file <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['miniImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                    <?php if (isset($formErrors['miniImageUpload'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['miniImageUpload'] ?></p>
                    <?php } ?>            
                </div> 
            </div>
            <div class="col-md-4">
                <table class="table">
                    <thead>
                        <th scope="col"></th>
                        <th scope="col">Minimum</th>
                        <th scope="col">Maximum</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Longueur (mètres)</th>
                            <td>
                                <input type="text" name="minWidth" id="minWidth" placeholder="Ex: 1" value="<?= isset($_POST['minWidth']) ? $_POST['minWidth'] : '' ?>" class="form-control <?= isset($_POST['minWidth']) && count($_POST) > 0 ? (isset($formErrors['minWidth']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['minWidth'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['minWidth'] ?></p>
                                <?php } ?>  
                            </td>
                            <td>
                                <input type="text" name="maxWidth" id="maxWidth" placeholder="Ex: 5" value="<?= isset($_POST['maxWidth']) ? $_POST['maxWidth'] : '' ?>" class="form-control <?= isset($_POST['maxWidth']) && count($_POST) > 0 ? (isset($formErrors['maxWidth']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['maxWidth'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['maxWidth'] ?></p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Hauteur (mètres)</th>
                            <td>
                                <input type="text" name="minHeight" id="minHeight" placeholder="Ex: 1" value="<?= isset($_POST['minHeight']) ? $_POST['minHeight'] : '' ?>" class="form-control <?= isset($_POST['minHeight']) && count($_POST) > 0 ? (isset($formErrors['minHeight']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['minHeight'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['minHeight'] ?></p>
                                <?php } ?>
                            </td>
                            <td>
                                <input type="text" name="maxHeight" id="maxHeight" placeholder="Ex: 5" value="<?= isset($_POST['maxHeight']) ? $_POST['maxHeight'] : '' ?>" class="form-control <?= isset($_POST['maxHeight']) && count($_POST) > 0 ? (isset($formErrors['maxHeight']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['maxHeight'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['maxHeight'] ?></p>
                                <?php } ?>
                            </td>
                         </tr>
                        <tr>
                            <th scope="row">Poids (tonnes)</th>
                            <td>
                                <input type="text" name="minWeight" id="minWeight" placeholder="Ex: 1" value="<?= isset($_POST['minWeight']) ? $_POST['minWeight'] : '' ?>" class="form-control <?= isset($_POST['minWeight']) && count($_POST) > 0 ? (isset($formErrors['minWeight']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['minWeight'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['minWeight'] ?></p>
                                <?php } ?>
                            </td>
                            <td>
                                <input type="text" name="maxWeight" id="maxWeight" placeholder="Ex: 5" value="<?= isset($_POST['maxWeight']) ? $_POST['maxWeight'] : '' ?>" class="form-control <?= isset($_POST['maxWeight']) && count($_POST) > 0 ? (isset($formErrors['maxWeight']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                                <?php if (isset($formErrors['maxWeight'])) { ?>
                                    <p class="text-danger text-center"><?= $formErrors['maxWeight'] ?></p>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<!-- Menus déroulants #### Période #### Habitat #### Alimentation #### Découverte -->
        <div class="row justify-content-between">
<!-- Menu Période -->
            <div class="form-group col-12 col-md <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="period">Choisissez une période :</label>
                <select name="period" class="form-control <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['period']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['period']) ? 'value="' . $_POST['period'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($showPeriods as $period) {
                    ?><option value="<?= $period->id ?>" <?= isset($_POST['period']) ? ($_POST['period'] == $period->id ? 'selected' : '') : '' ?>><?= $period->name ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['period'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['period'] ?></p>
                <?php } ?>
            </div>
<!-- Menu Habitat -->
            <div class="form-group col-12 col-md <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="habitat">Habitat principal :</label>
                <select name="habitat"  class="form-control <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['habitat']) ? 'value="' . $_POST['habitat'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($showEnvironments as $area) {
                    ?><option value="<?= $area->id ?>" <?= isset($_POST['habitat']) ? ($_POST['habitat'] == $area->id ? 'selected' : '') : '' ?>><?= $area->name ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['habitat'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['habitat'] ?></p>
                <?php } ?>
            </div>
<!-- Menu Alimentation #diet -->
            <div class="form-group col-12 col-md <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['diet']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="diet">Choisissez l'alimentation : </label>
                <select name="diet"  class="form-control <?=  isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['diet']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['diet']) ? 'value="' . $_POST['diet'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($showDiets as $diet) {
                    ?><option value="<?= $diet->id ?>" <?= isset($_POST['diet']) ? ($_POST['diet'] == $diet->id ? 'selected' : '') : '' ?>><?= $diet->name ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['diet'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['diet'] ?></p>
                <?php } ?>
            </div>
<!-- Découvert -->
            <div class="form-group col-12 col-md <?= count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="discoverer">Paléonthologue  : </label>
                <input type="text" placeholder="Ex: Allan Grant" name="discoverer" id="discoverer" class="form-control <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['discoverer']) ? 'value="' . $_POST['discoverer'] . '"' : '' ?> />
                <?php if (isset($formErrors['discoverer'])) { ?>
                    <p class="text-danger text-center"><?= $formErrors['discoverer'] ?></p>
                <?php } ?>
                </div>
            </div>
<!-- Description -->
            <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="description">Description : </label>
                <textarea type="text"  rows="10" name="description" id="description" placeholder="Description de la créature" class="form-control col <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>"><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                <?php if (isset($formErrors['description'])) { ?>
                    <p class="text-danger text-center"><?= $formErrors['description'] ?></p>
                <?php } ?>
                <!-- <div class="row">
                    <div class="col-md-4">
                        <label for="source">Source : </label>
                        <input type="text" class="form-control col" maxlength="50" placeholder="Ex: wikipedia" name="source" id="source" />
                    </div>
                    <div class="col-md-8">
                        <label for="sourceLink">Lien de la source : </label>
                        <input type="text" class="form-control col" maxlength="255" placeholder="Ex: https://wikipedia/tarteaucitron" name="sourceLink" id="sourceLink" />
                    </div>
                </div> -->
            </div>
            <div class="form-group text-center text-md-right">
                <input type="submit" class="btn btn-primary" value="Envoyer" name="sendNewCrea" />
            </div>
        </form>
    </div>
<?php } else { ?> 
    <?php include 'parts/redirect.php' ?> 
<?php } ?>
<?php include 'parts/footer.php' ?>