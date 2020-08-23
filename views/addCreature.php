<?php
$dinoPeriod = array('1' => 'Trias inférieur','2' => 'Trias moyen', '3' => 'Trias supérieur', '4' => 'Jurassique inférieur', '5' => 'Jurassique moyen', '6' => 'Jurassique supérieur', '7' => 'Crétacé inférieur', '8' => 'Crétacé supérieur');
$dinoType = array('Carnivore', 'Herbivore');
$environmentArray = array('USA', 'europe');
$categories = array('Dinosaure', 'Mammifère', 'Réptile marin', 'Réptile Volant', 'Autre');
?>
<div class="container border border-dark rounded p-5 mt-5">
    <form action="" method="post">
        
            <!-- Selection type de catégorie -->
            <div class="form-group d-flex justify-content-around">
                <?php 
                    foreach ($categories as $category) { ?>
                        <label for="<? $category ?>"><?= $category ?> : </label>
                        <input type="radio" name="typeSelect" id="<?= $category ?>" value="<?= $category ?>" />
                   <?php } ?>
            </div>
            <!-- Nom de la créature -->
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="creaName">Nom : </label>
                    <input type="text" class="form-control" id="creaName" name="creaName" placeholder="Nom de la Créature" />
                </div>
                <!-- Image principale de la créature -->
                <div class="form-group col-md-4">
                    <label for="sectionImage">Image de la créature : </label>
                    <input type="file" class="form-control-file" name="sectionImage" id="sectionImage" />
                </div> 
            </div>
        <div class="row justify-content-between">
            <div class="form-group col">
                <label for="period">Choisissez une période :</label>
                <select class="form-control" name="period">
                    <option value="" disabled selected>Selectionnez</option>
                    <?php
                        foreach ($dinoPeriod as $id => $period) {
                    ?><option value="<?= $id ?>"><?= $period ?></option><?php } ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="period">Habitat principal :</label>
                <select class="form-control" name="period">
                    <option value="" disabled selected>Selectionnez</option>
                    <?php
                    foreach ($environmentArray as $area) {
                    ?><option value="<?= $area ?>"><?= $area ?></option><?php } ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="diet">Choisissez l'alimentation : </label>
                <select class="form-control" name="diet">
                    <option value="" disabled selected>Selectionnez</option>
                    <?php
                    foreach ($dinoType as $type) {
                    ?><option value="<?= $type ?>"><?= $type ?></option><?php } ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="discoverer">Paléonthologue  : </label>
                <input type="text" class="form-control" maxlength="50" placeholder="Ex: Allan Grant" name="discoverer" id="discoverer" />
                <!-- PASSER L'input en minuscules puis avant envoie dans le BDD passer avec une Majuscule au début de chaque mot -->
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description : </label>
            <textarea type="text" class="form-control col" rows="10" id="description" placeholder="Description de la créature"></textarea>
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