<?php 
    include 'models/creatureModel.php';
    include 'controllers/dinoListController.php';
    generateBreadcrumb(array('index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<section class="container-fluid p-0">
<!-- Filtrage recherche -->
    <div id="filterArrow" class="text-center h-25">
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-arrow-down"></i></a>   
    </div>
    <div class="collapse p-5" id="collapseExample">
        <form method="GET" action="dinoList.php">
            <div class="row my-1">
                <!-- Filtrage période -->
                <select class="form-control col" name="period">
                    <option value="" disabled selected>Choisissez une période</option> 
                    <?php
                        foreach ($dinoPeriod as $period) {
                            ?><option value="<?= $period ?>"><?= $period ?></option><?php
                        }
                ?></select>
                <!-- Alimentation -->
                <select class="form-control offset-1 col" name="diet">
                    <option value="" disabled selected>Choisissez l'alimentation</option> 
                    <?php
                        foreach ($dinoType as $type) {
                            ?><option value="<?= $type ?>"><?= $type ?></option><?php
                        }
                ?></select> 
            </div>
            <div class="row">
                <select class="form-control col" name="discoverer">
                    <option value="" disabled selected>Paléonthologue</option> 
                    <?php
                        foreach ($discoverers as $discoverer) {
                            ?><option value="<?= $discoverer ?>"><?= $discoverer ?></option><?php
                        }
                ?></select>
                <select class="form-control offset-1 col" name="discoverer">
                    <option value="" disabled selected>Type de créature</option> 
                    <?php
                        foreach ($discoverers as $discoverer) {
                            ?><option value="<?= $discoverer ?>"><?= $discoverer ?></option><?php
                        }
                ?></select>
            </div>
            <div class="row my-1">
                <!-- champ de recherche -->
                <input class="form-control offset-8 col-2" type="search" placeholder="Rechercher" name="search" />
                <!-- envoi du formulaire -->
                <button type="submit" class="btn btn-primary col-2" name="sendFilter">Rechercher</button>
            </div>
        </form>
    </div>
<!-- Affichage resultat recherche -->
<div class="container mt-5">
    <div class="row text-center border justify-content-around">
            <?php
                foreach ($showCreaturesInfo as $creature) {
                ?><div class="col-4">
                        <a href="index.php?content=creature&id=<?= $creature->id?>">
                            <img class="img-fluid border border-dark" style="height: 150px" src="<?= isset($creature->miniImage) ? $creature->miniImage : '' ?>" />
                            <p><?= isset($creature->name) ? $creature->name : '' ?></p>
                        </a>
                </div><?php
                }?>
    </div>
</div>
<!-- Fin affichage resultat recherche -->    
</section>