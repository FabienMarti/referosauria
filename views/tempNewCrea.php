<?php
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../lang/FR_FR.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../models/creatureModel.php';
include '../controllers/connectionController.php';
include '../controllers/tempNewCreaCTRL.php';

include '../controllers/breadcrumb.php';
$pageTitle = 'Ajout de créature';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'dinoList.php?page=1' => 'Liste des dinosaures'  , 'final' => 'Ajout de créature'));

if(isset($_SESSION['profile']) && $_SESSION['profile']['roleId'] != 1) {
    include 'parts/redirect.php'; 
} else { 
    ?>
    <section class="container-fluid my-2">
    <form action="" method="POST">
        <div class="row">
            <h1 class="col text-center"><u><i class="fas fa-wrench"></i><input class="text-center creaName" type="text" value="" placeholder="Ex: Tyrannosaure" /></u></h1>
        </div>
        <div class="row divBackColor">
            <!-- Carte localisation JavaScript avec DropDown lieu -->
            <div class="col-md-2 text-center border divBackColor">
                <img id="#" class="imgPreview img-fluid mt-3" src="http://placehold.it/180" alt="Image" /> 
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <img id="img1" class="imgPreview" src="http://placehold.it/180" alt="Image" />
                        <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                            <input onchange="readURL1(this)" type="file" name="mainImageUpload" id="mainImageUpload" class="form-control-file <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                            <?php if (isset($formErrors['mainImageUpload'])) { ?>
                                <p class="text-danger text-center"><?= $formErrors['mainImageUpload'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm divBackColor">
                            <thead>
                                <th colspan="2" class="text-center"><i class="fas fa-wrench"></i> Fiche signalétique</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Environement -->
                                    <th scope="row">Habitat</th>
                                    <td>
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'has-danger' : 'has-success') : '' ?>">
                                        <select name="habitat"  class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['habitat']) ? 'value="' . $_POST['habitat'] . '"' : '' ?>>
                                            <option value="" disabled selected>Choisissez</option>
                                            <?php
                                                foreach ($showEnvironments as $env) {
                                            ?><option value="<?= $env->id ?>" <?= isset($_POST['habitat']) ? ($_POST['habitat'] == $env->id ? 'selected' : '') : '' ?>><?= $env->name ?></option><?php } ?>
                                        </select>
                                        <?php if (isset($formErrors['habitat'])) { ?>
                                                <p class="text-danger text-center"><?= $formErrors['habitat'] ?></p>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- Période -->
                                    <th scope="row">Période</th>
                                    <td>
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'has-danger' : 'has-success') : '' ?>">
                                            <select name="period" class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['period']) ? 'value="' . $_POST['period'] . '"' : '' ?>>
                                                <option value="" disabled selected>Choisissez</option>
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
                                    <th scope="row">Longueur</th>
                                    <td>
                                        <input type="text" name="minWidth" id="minWidth" size="1" />m à
                                        <input type="text" name="maxWidth" id="maxWidth" size="1" />m
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hauteur</th>
                                    <td>
                                        <input type="text" name="minHeight" id="minHeight" size="1" />m à
                                        <input type="text" name="maxHeight" id="maxHeight" size="1" />m
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Poids</th>
                                    <td>
                                        <input type="text" name="minWeight" id="minWeight" size="1" />T à
                                        <input type="text" name="maxWeight" id="maxWeight" size="1" />T
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Prédateurs</th>
                                    <td>
                                        <div class="form-group">
                                        <input type="text" name="predatory" id="predatory" class="form-control" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alimentation</th>
                                    <td>
                                        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'has-danger' : 'has-success') : '' ?>">
                                            <select name="diet"  class="form-control form-control-sm <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['diet']) ? 'value="' . $_POST['diet'] . '"' : '' ?>>
                                                <option value="" disabled selected>Choisissez</option>
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
            <div class="col-md-6 m-auto divBackColor rounded">
                <p class="h5 text-center"><i class="fas fa-wrench"></i> Description</p>
                <textarea class="form-control" rows="20"></textarea>
<!-- Probleme BDD pour les sources -->
                <p class="text-right">
                    <i class="fas fa-wrench"></i><input disabled type="text" name="descSource" value="Source : WIKIPEDIA" />
                </p>
            </div>
        </div>
        <div class="text-center">
            <input type="submit" class="btn" name="sendEditedCrea" value="Enregistrer la créature   " />
        </div>
        </form>
</section> <?php

 } ?>   
<img src='https://img.icons8.com/ios/500/circled-up-2.png' onclick="backToTop()" class="creaName" alt='flèche' width="50px" height="50px" />
<?php include 'parts/footer.php' ?>