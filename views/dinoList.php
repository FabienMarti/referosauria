<?php 
    $pageTitle = 'Liste des créatures';
    include 'parts/header.php';
    include '../models/database.php';
    include '../models/creatureModel.php';
    include '../controllers/dinoListController.php';
    include '../controllers/breadcrumb.php';
    generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<section class="container-fluid p-0">
<!-- Filtrage recherche -->
    <div class="collapse p-5 filter" id="collapseExample">
        <form method="POST" action="">
            <div class="row my-1">
                <!-- Filtrage période -->
                <select class="form-control col" name="period">
                    <option value="" disabled selected>Choisissez une période</option> 
                    <?php
                        foreach ($showCreaturesInfo as $period) {
                            ?><option value="<?= $period->id_period ?>"><?= $period->periodName ?></option><?php
                        }
                ?></select>
                <!-- Alimentation -->
                <select class="form-control offset-1 col" name="diet">
                    <option value="" disabled selected>Choisissez l'alimentation</option> 
                    <?php
                        foreach ($dinoType as $id => $type) {
                            ?><option value="<?= $id ?>"><?= $type ?></option><?php
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
    <div class="text-center h-25 filter">
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="returnArrow(JSarrow)"><i id="JSarrow" class="fas fa-arrow-down"></i></a>   
    </div>
<!-- Affichage resultat recherche -->
<div class="container mt-5">
    <div class="row text-center justify-content-around">
            <?php
                foreach ($showCreaturesInfo as $creature) {
                ?><div class="col-4">
                        <a href="creature.php?id=<?= $creature->id ?>">
                            <img alt="une illustration de <?= $creature->name ?>" title="<?= $creature->name ?>" class="img-fluid border" style="height: 150px" src="<?= $linkModif . $creature->miniImage ?>" />
                            <p class="creaName"><?= $creature->name ?></p>
                        </a>
                </div><?php
            }?>
    </div>
</div>
<!-- Fin affichage resultat recherche -->    
</section>
<script>
    function returnArrow(i){
        if(i.classList.contains('fa-arrow-down')){
        i.setAttribute('class', 'fa-arrow-up');
        }else{
            i.setAttribute('class', 'fa-arrow-down');
        }
    }
</script>
<?php include 'parts/footer.php' ?>