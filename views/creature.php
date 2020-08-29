<?php
include '../models/database.php';
    include '../models/creatureModel.php';   
    include '../controllers/creatureController.php';
    $pageTitle = (isset($showCreatureInfo->name) ? $showCreatureInfo->name : ''); 
    include 'parts/header.php';
    include '../controllers/breadcrumb.php';
    generateBreadcrumb(array('../index.php' => 'Referosauria', 'dinoList.php' => 'Liste des dinosaures', 'final' => $showCreatureInfo->name));
?>
<section class="container-fluid my-2">
        <h1 class="text-center my-5 creaName"><u><?= isset($showCreatureInfo->name) ? $showCreatureInfo->name : '' ?></u></h1>
        <div class="row">
            <div class="col-md-2 text-center border divBackColor">
                <p class="h6 text-center">Où a-t-on trouvé Tyrannosaure ?</p>
                <img src="../assets/img/localTyrannosaurus.png" class="img-fluid" />
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
            <div class="col-4">
                <div class="row">
                    <div class="col-md-12 m-auto">
                        <img class="img-fluid" src="../<?= isset($showCreatureInfo->mainImage) ? $showCreatureInfo->mainImage : '' ?>" />
                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm divBackColor">
                            <thead>
                                <th colspan="2" class="text-center">Fiche signalétique</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Habitat</th>
                                    <td><?= isset($showCreatureInfo->environment) ? $showCreatureInfo->environment : '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Période</th>
                                    <td><?= isset($showCreatureInfo->period) ? $showCreatureInfo->period : '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Longueur</th>
                                    <td><?= isset($showCreatureInfo->width) ? $showCreatureInfo->width : '' ?> mètres</td>
                                </tr>
                                <tr>
                                    <th scope="row">Hauteur</th>
                                    <td><?= isset($showCreatureInfo->height) ? $showCreatureInfo->height : '' ?> mètres</td>
                                </tr>
                                <tr>
                                    <th scope="row">Poids</th>
                                    <td><?= isset($showCreatureInfo->weight) ? $showCreatureInfo->weight : '' ?> tonnes</td>
                                </tr>
                                <tr>
                                    <th scope="row">Prédateurs</th>
                                    <td><?= isset($showCreatureInfo->predatory) ? $showCreatureInfo->predatory : '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alimentation</th>
                                    <td><?= isset($showCreatureInfo->diet) ? $showCreatureInfo->diet : '' ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-auto divBackColor rounded">
                <p class="h5 text-center">Description</p>
                <p><?= $showCreatureInfo->description ?></p>
<!-- Probleme BDD pour les sources -->
                <p class="text-right">Source : WIKIPEDIA</p>
            </div>
            <div class="col-md-1 text-center divBackColor">
                <p class="h5 text-center">Ils ont vécus dans la même période :</p>
                <div><img src="../assets/img/rexHead.png" style="width:100px; height:100px;" class="m-3 border border-danger" /></div>
                <div><img src="../assets/img/parasaurolophusHead.jpg" style="width:100px; height:100px;" class="m-3 border border-success" /></div>
                <div><img src="../assets/img/rexHead.png" style="width:100px; height:100px;" class="m-3 border border-danger" /></div>
            </div>
        </div>
</section>
<section class="mx-1">
    <h1 class="text-center my-5 creaName">Plus de détails</h1>
    <div class="row">
        <!-- <div class="col-md-2">
            <table class="table table-sm">
                <thead>
                    <th colspan="2" class="text-center">Classification</th>
                </thead>
                <tr>
                    <th>Super-ordre</th>
                    <td>Dinosauria</td>
                </tr>
                <tr>
                    <th>Ordre</th>
                    <td>Saurischia</td>
                </tr>
                <tr>
                    <th>Sous-ordre</th>
                    <td>Theropoda</td>
                </tr>
                <tr>
                    <th>Infra-Ordre</th>
                    <td>Tetunurae</td>
                </tr>
                <tr>
                    <th>Micro-ordre</th>
                    <td>Coelurosauria</td>
                </tr>
                <tr>
                    <th>Super-famille</th>
                    <td>Tyrannosauroidea</td>
                </tr>
                <tr>
                    <th>Famille</th>
                    <td>Tyrannosauridae</td>
                </tr>
                <tr>
                    <th>Sous-ordre</th>
                    <td>Tyrannosaurinae</td>
                </tr>
            </table>
        </div> -->
        <div class="col-md-4">
            <table class="table table-sm divBackColor">
                <thead>
                    <th colspan="2" class="text-center">Fiche signalétique</th>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Habitat</th>
                        <td><?= isset($showCreatureInfo->environment) ? $showCreatureInfo->environment : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Période</th>
                        <td><?= isset($showCreatureInfo->period) ? $showCreatureInfo->period : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Longueur</th>
                        <td><?= isset($showCreatureInfo->width) ? $showCreatureInfo->width : '' ?> mètres</td>
                    </tr>
                    <tr>
                        <th scope="row">Hauteur</th>
                        <td><?= isset($showCreatureInfo->height) ? $showCreatureInfo->height : '' ?> mètres</td>
                    </tr>
                    <tr>
                        <th scope="row">Poids</th>
                        <td><?= isset($showCreatureInfo->weight) ? $showCreatureInfo->weight : '' ?> tonnes</td>
                    </tr>
                    <tr>
                        <th scope="row">Prédateurs</th>
                        <td><?= isset($showCreatureInfo->predatory) ? $showCreatureInfo->predatory : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Alimentation</th>
                        <td><?= isset($showCreatureInfo->diet) ? $showCreatureInfo->diet : '' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <figure>
                <img class="img-fluid" alt="squelette de Tyrannosaure" src="<?= $linkModif ?><?= isset($showCreatureInfo->detailImage) ? $showCreatureInfo->detailImage : '' ?>" />
                <figcaption class="text-center">Tyrannosaure "Sue" au Field Museum, Chicago, USA, 2010</figcaption>
            </figure>
        </div>
        <div class="col-md-4 divBackColor">
            <h2 class="text-center">Découverte</h2>
            <p class="text-justify"><?= isset($showCreatureInfo->discovery) ? $showCreatureInfo->discovery : '' ?></p>
            <p class="text-right">Source : WIKIPEDIA</p>
        </div>
    </div>
    <div class="row justify-content-around my-2">
        <div class="col-md-5 divBackColor">
            <h2 class="text-center">Etymologie</h2>
            <p class="text-justify"><?= isset($showCreatureInfo->etymology) ? $showCreatureInfo->etymology : '' ?></p>
            <p class="text-right">Source : WIKIPEDIA</p>
        </div>
        <div class="col-md-5 divBackColor">
            <h2 class="text-center">Paléo-biologie</h2>
            <p><?= isset($showCreatureInfo->paleobiology) ? $showCreatureInfo->paleobiology : '' ?></p>
            <p class="text-right">Source : WIKIPEDIA</p>
        </div>
    </div>
</section>
<?php include 'parts/footer.php' ?>