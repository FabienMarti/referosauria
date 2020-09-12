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
?>
<section class="container-fluid my-2">
    <form action="" method="POST">
        <div class="row">
            <h1 class="col text-center"><u><i class="fas fa-wrench"></i><input class="text-center creaName" type="text" disabled value="<?= $showCreatureInfo->name ?>" /></u></h1>
        </div>
        <div class="row">
            <div class="col-md-2 text-center border divBackColor">
                <p class="h6 text-center">Où a-t-on trouvé <?= $showCreatureInfo->name ?>  ?</p>
                <img src="<?= '../assets/img/local/' . $areaMap . '.jpg' ?>" class="img-fluid" />
                <p class="h5 mt-5">Derniers sujets en rapport :</p>
                <ul class="border" id="recentPostList">
                    <li><a href="#">Le tyrannosaure pouvait-il voler ?</a></li>
                    <li>12/05/2020</li>
                    <li><a href="#">Les films avec un ou des tyrannosaures</a></li>
                    <li>05/02/2020</li>
                    <li><a href="#">Sa mangé quoi un tyronasaure ??</a></li>
                    <li>28/01/2020</li>
                </ul>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <img class="img-fluid" src="../<?= $showCreatureInfo->mainImage ?>" /> 
                        <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                            <input type="file" name="mainImageUpload" id="mainImageUpload" class="form-control-file <?= count($_POST) > 0 ? (isset($formErrors['mainImageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
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
                                            <option value="<?= $showCreatureInfo->envId ?>" disabled selected><?= $showCreatureInfo->envName ?></option>
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
                                    <th scope="row">Longueur</th>
                                    <td>
                                        <input type="text" name="minWidth" id="minWidth" size="1" value="<?= $showCreatureInfo->minWidth ?>" />m à
                                        <input type="text" name="maxWidth" id="maxWidth" size="1" value="<?= $showCreatureInfo->maxWidth ?>" />m
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Hauteur</th>
                                    <td>
                                        <input type="text" name="minHeight" id="minHeight" size="1" value="<?= $showCreatureInfo->minHeight ?>" />m à
                                        <input type="text" name="maxHeight" id="maxHeight" size="1" value="<?= $showCreatureInfo->maxHeight ?>" />m
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Poids</th>
                                    <td>
                                        <input type="text" name="minWeight" id="minWeight" size="1" value="<?= $showCreatureInfo->minWeight ?>" />T à
                                        <input type="text" name="maxWeight" id="maxWeight" size="1" value="<?= $showCreatureInfo->maxWeight ?>" />T
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Prédateurs</th>
                                    <td>
                                        <input type="text" name="predatory" id="predatory" value="<?= $showCreatureInfo->predatory ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Alimentation</th>
                                    <td>
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
                <textarea class="form-control" rows="20"><?= $showCreatureInfo->description ?></textarea>
<!-- Probleme BDD pour les sources -->
                <p class="text-right">
                    <i class="fas fa-wrench"></i><input type="text" name="descSource" value="Source : WIKIPEDIA" />
                </p>
            </div>
            <div class="col-md-1 text-center divBackColor">
                <p class="h5 text-center">Ils ont vécus dans la même période :</p>
                <?php foreach($showCreaturesByPeriod as $crea){ ?>
                    <div><a href="creature.php?id=<?= $crea->id ?>"><img src="<?= $crea->miniImage ?>" width="100px" height="100px"  class="m-3" /></a></div>
                <?php } ?>
            </div>
        </div>
        <div class="form-group col-2">
            <input type="submit" class="btn form-control" name="sendEditedCrea" value="Valider l'édition" />
        </div>
        </form>
</section>





















<img src='https://img.icons8.com/ios/500/circled-up-2.png' onclick="backToTop()" class="creaName" alt='flèche' width="50px" height="50px" />
<?php include 'parts/footer.php' ?>