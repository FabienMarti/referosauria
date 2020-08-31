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
    <div class="collapse filter" id="collapseExample">
        <form method="POST" action="" class="py-1 px-5">
            <div class="row my-1">
                <!-- Filtrage période -->
                <select class="form-control form-control-sm col" name="period">
                    <option value="" disabled selected>Choisissez une période</option> 
                    <?php
                        foreach ($showCreaPeriods as $period) {
                            ?><option value="<?= $period->id ?>"><?= $period->name ?></option><?php
                        }
                ?></select>
                <!-- Alimentation -->
                <select class="form-control form-control-sm offset-1 col" name="diet">
                    <option value="" disabled selected>Choisissez l'alimentation</option> 
                    <?php
                        foreach ($showCreaDiets as $diet) {
                            ?><option value="<?= $diet->id ?>"><?= $diet->name ?></option><?php
                        }
                ?></select> 
            </div>
                <!-- Paleonthologue à l'origine de la découverte -->
            <div class="row">
                <select class="form-control form-control-sm col" name="discoverer">
                    <option value="" disabled selected>Paléonthologue</option> 
                    </select>
                <!-- Catégorie -->
                <select class="form-control form-control-sm offset-1 col" name="category">
                    <option value="" disabled selected>Catégorie de créature</option> 
                    <?php
                        foreach ($showCreaCategories as $category) {
                            ?><option value="<?= $category->id ?>"><?= $category->name ?></option><?php
                        }
                ?></select>
            </div>
            <div class="row my-1">
                <!-- champ de recherche -->
                <input class="form-control offset-8 col-2" id="searchField" name="searchField" type="text" placeholder="Rechercher une créature ..."  />
                <!-- envoi du formulaire -->
                <button type="submit" class="btn col-1  form-control" name="searchCrea">Rechercher</button>
            </div>
        </form>
    </div>
    <div class="text-center h-25 filter">
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="returnArrow(JSarrow)"><i id="JSarrow" class="fas fa-arrow-down"></i></a>   
    </div>
<!-- Affichage resultat recherche -->
<?php
if(isset($resultsNumber) &&  $resultsNumber == 0){ ?>
        <p class="text-center h1 m-5 titleStyle"><?= $searchMessage ?></p><?php
}else { ?>
<div class="container mt-5">
    <div class="row text-center justify-content-around">
            <?php
                foreach ($showCreaList  as $creature) {
                ?><div class="col-3">
                        <a href="creature.php?id=<?= $creature->id ?>">
                            <img alt="une illustration de <?= $creature->name ?>" title="<?= $creature->name ?>" class="img-fluid border border-dark" width="150px" height="150px" src="<?= $linkModif . $creature->miniImage ?>" />
                            <p class="creaName"><?= $creature->name ?></p>
                        </a>
                </div><?php
            }?>
    </div>
</div> 
<?php } ?>
<!---------------------------------->
<div class="text-center m-3">
    <?php //affiche le numero des page
        $beginPage = $page - 3;

        if($beginPage < 1){
            $beginPage = 1;
        }

        if ($page != 1){ ?>
            <a href="dinoList.php?page=1" class="btn"><i class="fas fa-angle-double-left"></i></a>
            <a href="dinoList.php?page=<?=($page - 1)?>" class="btn"><i class="fas fa-angle-left"></i></a><?php
        }

        if ($page > 4){ ?>
            <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a><?php 
        }
        $endPage = $page + 3;
        if($endPage > $pageNumber) {
            $endPage = $pageNumber;
        }
        for ($i = $beginPage; $i <= $endPage; $i++) {?>
            <a href="dinoList.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-danger' : '' ?>"><?= $i ?></a><?php 
        } 
        if ($page < $pageNumber - 3){ ?>
            <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a>
        <?php }
        if ($page != $pageNumber){ ?>
            <a href="dinoList.php?page=<?=($page + 1) ?>" class="btn"><i class="fas fa-angle-right"></i></a>
            <a href="dinoList.php?page=<?= $pageNumber ?>" class="btn"><i class="fas fa-angle-double-right"></i></a>
        <?php } ?>
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