<?php 
$pageTitle = 'Ajout créature';
include 'parts/header.php';
include '../controllers/addCreatureController.php';
include '../controllers/breadcrumb.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<div class="container border border-dark rounded pt-5 px-5 my-5">
    <form action="" method="POST" enctype="multipart/form-data">
<!-- Selection type de catégorie -->
            <p>Sélectionnez un type de créature : </p>
            <div class="form-group d-flex justify-content-between">
                <?php 
                    foreach ($categories as $category) { ?>
                        <label class="my-auto" for="<? $category ?>"><?= $category ?> : </label>
                        <input type="radio" name="typeSelect" id="<?= $category ?>" value="<?= $category ?>" <?= isset($_POST['typeSelect']) && $_POST['typeSelect'] == $category ? 'checked' : '' ?> class="my-auto <?= isset($formErrors['typeSelect']) ? 'is-invalid' : (isset($typeSelect) ? 'is-valid' : '') ?>" />
                   <?php } 
                   if (isset($formErrors['typeSelect'])) { ?>
                        <div class="text-danger d-block"><?= $formErrors['typeSelect'] ?></div>
                    <?php } ?>
            </div>
<!-- Nom de la créature -->
            <div class="row">
                <div class="form-group col-md-8 <?= count($_POST) > 0 ? (isset($formErrors['creaName']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for="creaName">Nom : </label>
                    <input type="text" id="creaName" name="creaName" placeholder="Nom de la Créature" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['creaName']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['creaName']) ? 'value="' . $_POST['creaName'] . '"' : '' ?> />
            <?php if (isset($formErrors['creaName'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['creaName'] ?></p>
            <?php } ?>
                </div>
<!-- Image principale de la créature FILE -->
                <div class="form-group col-md-4 <?= count($_POST) > 0 ? (isset($formErrors['imageUpload']) ? 'has-danger' : 'has-success') : '' ?>">
                    <label for="imageUpload">Image de la créature : </label>
                    <input type="file" name="imageUpload" id="imageUpload" class="form-control-file <?= count($_POST) > 0 ? (isset($formErrors['imageUpload']) ? 'is-invalid' : 'is-valid') : '' ?>" />
            <?php if (isset($formErrors['imageUpload'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['imageUpload'] ?></p>
            <?php } ?>
                </div> 
            </div>
<!-- Menus déroulants #### Période #### Habitat #### Alimentation #### Découverte -->
        <div class="row justify-content-between">
<!-- Menu Période -->
            <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="period">Choisissez une période :</label>
                <select name="period" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['period']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['period']) ? 'value="' . $_POST['period'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($dinoPeriod as $period) {
                    ?><option value="<?= $period ?>" <?= isset($_POST['period']) ? ($_POST['period'] == $period ? 'selected' : '') : '' ?>><?= $period ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['period'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['period'] ?></p>
                <?php } ?>
            </div>
<!-- Menu Habitat -->
            <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="habitat">Habitat principal :</label>
                <select name="habitat"  class="form-control <?= count($_POST) > 0 ? (isset($formErrors['habitat']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['habitat']) ? 'value="' . $_POST['habitat'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($environmentArray as $area) {
                    ?><option value="<?= $area ?>" <?= isset($_POST['habitat']) ? ($_POST['habitat'] == $area ? 'selected' : '') : '' ?>><?= $area ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['habitat'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['habitat'] ?></p>
                <?php } ?>
            </div>
<!-- Menu Alimentation -->
            <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="diet">Choisissez l'alimentation : </label>
                <select name="diet"  class="form-control <?= count($_POST) > 0 ? (isset($formErrors['diet']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['diet']) ? 'value="' . $_POST['diet'] . '"' : '' ?>>
                    <option value="" disabled selected>Sélectionnez</option>
                    <?php
                        foreach ($dinoType as $type) {
                    ?><option value="<?= $type ?>" <?= isset($_POST['diet']) ? ($_POST['diet'] == $type ? 'selected' : '') : '' ?>><?= $type ?></option><?php } ?>
                </select>
                <?php if (isset($formErrors['diet'])) { ?>
                        <p class="text-danger text-center"><?= $formErrors['diet'] ?></p>
                <?php } ?>
            </div>
<!--  -->
            <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'has-danger' : 'has-success') : '' ?>">
                <label for="discoverer">Paléonthologue  : </label>
                <input type="text" placeholder="Ex: Allan Grant" name="discoverer" id="discoverer" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['discoverer']) ? 'value="' . $_POST['discoverer'] . '"' : '' ?> />
            <?php if (isset($formErrors['discoverer'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['discoverer'] ?></p>
            <?php } ?>
            </div>
        </div>
        <div class="form-group <?= count($_POST) > 0 ? (isset($formErrors['discoverer']) ? 'has-danger' : 'has-success') : '' ?>">
            <label for="description">Description : </label>
            <textarea type="text"  rows="10" name="description" id="description" placeholder="Description de la créature" class="form-control col <?= count($_POST) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>"><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
            <?php if (isset($formErrors['description'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['description'] ?></p>
            <?php } ?>
            <div class="row">
                <div class="col-md-4">
                    <label for="source">Source : </label>
                    <input type="text" class="form-control col" maxlength="50" placeholder="Ex: wikipedia "name="source" id="source" />
                </div>
                <div class="col-md-8">
                    <label for="sourceLink">Lien de la source : </label>
                    <input type="text" class="form-control col" maxlength="255" placeholder="Ex: https://wikipedia/tarteaucitron" name="sourceLink" id="sourceLink" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Envoyer" name="sendNewCrea" />
        </div>
    </form>
</div>
<?php include 'parts/footer.php' ?>