<?php
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../models/creatureModel.php';
include '../controllers/connectionController.php';
include '../controllers/editCreatureController.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';
$pageTitle =  'Edition de ' . $showCreatureInfo->name; 
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'dinoList.php?page=1' => 'Liste des dinosaures', 'creature.php?id=' . $showCreatureInfo->id => $showCreatureInfo->name, 'final' => 'Edition de ' . $showCreatureInfo->name));

if(isset($_SESSION['profile']) && $_SESSION['profile']['roleId'] != 1) {
    include 'parts/redirect.php'; 
} else { ?>
    <section class="container-fluid my-2">
    <form action="" method="POST">
        <div class="row">
            <h1 class="col text-center"><u><i class="fas fa-wrench"></i><input class="text-center creaName" type="text" name="creaName" value="<?= $showCreatureInfo->name ?>" /></u></h1>
        </div>
        <div class="row">
            <div class="col-md-2 text-center border divBackColor">
                <p class="h6 text-center">Où a-t-on trouvé <?= $showCreatureInfo->name ?>  ?</p>
                <img src="<?= '../assets/img/local/' . $areaMap . '.jpg' ?>" class="img-fluid" />
                <label for="categories">Catégorie</label>
                <select name="categories" id="categories" class="form-control">
                    <option selected disabled value="<?= $showCreatureInfo->catId ?> "><?= $showCreatureInfo->catName ?></option>
                <?php
                    foreach ($showCategories as $category) { ?>
                        <option value="<?= $category->id ?> "><?= $category->name ?></option>
                    <?php } ?>
                </select>
                <div class="form-group">
                    <label for="discovery">Paléonthologue à l'origine de la découverte</label>
                    <input type="text" name="discovery" id="discovery" value="<?= $showCreatureInfo->discovery ?>" class="form-control" />
                </div>
                <!-- Mini image de la créature FILE -->
                <div class="text-center">
                    <img id="img2" class="imgPreview" src="../<?= $showCreatureInfo->miniImage ?>" alt="Image" />
                    <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['miniImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="miniImageUpload">Image de tête de la créature : </label>
                        <input onchange="readURL2(this)" type="file" name="miniImageUpload" id="miniImageUpload" class="form-control-file <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['miniImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                        <?php if (isset($formErrors['miniImageUpload'])) { ?>
                            <p class="text-danger text-center"><?= $formErrors['miniImageUpload'] ?></p>
                        <?php } ?>            
                    </div> 
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <!-- Image principale de la créature FILE -->
                <div class="text-center">
                    <img id="img1" class="img-fluid" src="../<?= $showCreatureInfo->mainImage ?>" alt="Image" />
                    <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="mainImageUpload">Image principale de la créature : </label>
                        <input onchange="readURL1(this)" type="file" name="mainImageUpload" id="mainImageUpload" class="form-control-file <?= isset($_POST['sendNewCrea']) && count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                        <?php if (isset($formErrors['mainImageUpload'])) { ?>
                            <p class="text-danger text-center"><?= $formErrors['mainImageUpload'] ?></p>
                        <?php } ?>
                    </div>
                </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm divBackColor">
                            <thead>
                                <th colspan="3" class="text-center"><i class="fas fa-wrench"></i> Fiche signalétique</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Environement -->
                                    <th scope="row">Habitat</th>
                                    <td colspan="2">
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'has-danger' : 'has-success') : '' ?>">
                                            <select name="habitat"  class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['habitat']) ? 'value="' . $_POST['habitat'] . '"' : '' ?>>
                                                <option value="<?= $showCreatureInfo->envId ?>" disabled selected><?= $showCreatureInfo->envName ?></option>
                                                <?php
                                                    foreach ($showEnvironments as $env) {
                                                ?><option value="<?= $env->id ?>" <?= isset($_POST['habitat']) ? ($_POST['habitat'] == $env->id ? 'selected' : '') : '' ?>><?= $env->name ?></option><?php } ?>
                                            </select>
                                            <?php if (isset($formErrors['habitat'])) { ?>
                                                    <p class="text-danger text-center"><?= $formErrors['habitat'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Période -->
                                    <th scope="row">Période</th>
                                    <td colspan="2">
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'has-danger' : 'has-success') : '' ?>">
                                            <select name="period" class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['period']) ? 'value="' . $_POST['period'] . '"' : '' ?>>
                                                <option value="<?= $showCreatureInfo->perId ?>" disabled selected><?= $showCreatureInfo->perName ?></option>
                                                <?php
                                                    foreach ($showPeriods as $period) {
                                                ?><option value="<?= $period->id ?>" <?= isset($_POST['period']) ? ($_POST['period'] == $period->id ? 'selected' : '') : '' ?>><?= $period->name ?></option><?php } ?>
                                            </select>
                                            <?php if (isset($formErrors['period'])) { ?>
                                                    <p class="text-danger text-center"><?= $formErrors['period'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Longueur (mètres)</th>
                                    <td>
                                        <input type="text" name="minWidth" id="minWidth" placeholder="Ex: 1" class="form-control <?= isset($_POST['minWidth']) && count($_POST) > 0 ? (isset($formErrors['minWidth']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->minWidth ?>"/>
                                        <?php if (isset($formErrors['minWidth'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['minWidth'] ?></p>
                                        <?php } ?>  
                                    </td>
                                    <td>
                                        <input type="text" name="maxWidth" id="maxWidth" placeholder="Ex: 5" class="form-control <?= isset($_POST['maxWidth']) && count($_POST) > 0 ? (isset($formErrors['maxWidth']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->maxWidth ?>" />
                                        <?php if (isset($formErrors['maxWidth'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['maxWidth'] ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hauteur (mètres)</th>
                                    <td>
                                        <input type="text" name="minHeight" id="minHeight" placeholder="Ex: 1" class="form-control <?= isset($_POST['minHeight']) && count($_POST) > 0 ? (isset($formErrors['minHeight']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->minHeight ?>" />
                                        <?php if (isset($formErrors['minHeight'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['minHeight'] ?></p>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <input type="text" name="maxHeight" id="maxHeight" placeholder="Ex: 5" class="form-control <?= isset($_POST['maxHeight']) && count($_POST) > 0 ? (isset($formErrors['maxHeight']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->maxHeight ?>" />
                                        <?php if (isset($formErrors['maxHeight'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['maxHeight'] ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Poids (tonnes)</th>
                                    <td>
                                        <input type="text" name="minWeight" id="minWeight" placeholder="Ex: 1" class="form-control <?= isset($_POST['minWeight']) && count($_POST) > 0 ? (isset($formErrors['minWeight']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->minWeight ?>" />
                                        <?php if (isset($formErrors['minWeight'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['minWeight'] ?></p>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <input type="text" name="maxWeight" id="maxWeight" placeholder="Ex: 5" class="form-control <?= isset($_POST['maxWeight']) && count($_POST) > 0 ? (isset($formErrors['maxWeight']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= $showCreatureInfo->minWeight ?>" />
                                        <?php if (isset($formErrors['maxWeight'])) { ?>
                                            <p class="text-danger text-center"><?= $formErrors['maxWeight'] ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Prédateurs</th>
                                    <td colspan="2">
                                        <div class="form-group">
                                        <input type="text" name="predatory" id="predatory" value="<?= $showCreatureInfo->predatory ?>" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alimentation</th>
                                    <td colspan="2">
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'has-danger' : 'has-success') : '' ?>">
                                            <select name="diet"  class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['diet']) ? 'value="' . $_POST['diet'] . '"' : '' ?>>
                                                <option value="<?= $showCreatureInfo->dietId ?>" disabled selected><?= $showCreatureInfo->dietName ?></option>
                                                <?php
                                                    foreach ($showDiets as $diet) {
                                                ?><option value="<?= $diet->id ?>" <?= isset($_POST['diet']) ? ($_POST['diet'] == $diet->id ? 'selected' : '') : '' ?>><?= $diet->name ?></option><?php } ?>
                                            </select>
                                            <?php if (isset($formErrors['diet'])) { ?>
                                                    <p class="text-danger text-center"><?= $formErrors['diet'] ?></p>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-auto divBackColor rounded">
                <p class="h5 text-center"><i class="fas fa-wrench"></i> Description</p>
                <textarea class="form-control" rows="20" name="description"><?= $showCreatureInfo->description ?></textarea>
                <p class="text-right">
                    <i class="fas fa-wrench"></i><input disabled type="text" name="descSource" value="Source : WIKIPEDIA" />
                </p>
            </div>
            <div class="col-md-1 text-center divBackColor">
                <p class="h5 text-center">Ils ont vécus dans la même période :</p>
            </div>
        </div>
        <div class="text-center">
            <input type="submit" class="btn" name="sendEditedCrea" value="Valider l'édition" />
        </div>
        </form>
</section> <?php

 } ?>   
<img src='https://img.icons8.com/ios/500/circled-up-2.png' onclick="backToTop()" class="creaName" alt='flèche' width="50px" height="50px" />
<?php include 'parts/footer.php' ?>