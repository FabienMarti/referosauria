<?php
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../models/creatureModel.php';
include '../controllers/creatureController.php';
$pageTitle =  $showCreatureInfo->name; 
include '../controllers/connectionController.php';
include '../controllers/breadcrumb.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'dinoList.php?page=1' => 'Liste des dinosaures', 'final' => $showCreatureInfo->name));
?>
<section class="container-fluid my-2">
        <div class="row">
            <h1 class="text-center creaName col"><u><?= $showCreatureInfo->name ?></u></h1>
            <div class="dropdown dropleft float-left my-auto">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="editCreature.php?id=<?= $showCreatureInfo->id ?>"><i class="fas fa-wrench"></i> Modifier</a>
                    <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Supprimer créature</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-center border divBackColor">
                <p class="h6 text-center">Où a-t-on trouvé <?= $showCreatureInfo->name ?> ?</p>
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
                    <div class="col-md-12 text-center">
                        <img class="img-fluid" src="../<?= $showCreatureInfo->mainImage ?>" /> 
                    </div>
                    <div class="col-md-12">
                        <table class="table table-sm divBackColor">
                            <thead>
                                <th colspan="2" class="text-center">Fiche signalétique</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Habitat</th>
                                    <td><?= $showCreatureInfo->envName ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Période</th>
                                    <td><?= $showCreatureInfo->perName ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Longueur</th>
                                    <td><?= $showCreatureInfo->minWidth ?>m<?= isset($showCreatureInfo->maxWidth) ? '  à  ' .$showCreatureInfo->maxWidth . 'm': '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Hauteur</th>
                                    <td><?= $showCreatureInfo->minHeight ?>m<?= isset($showCreatureInfo->maxHeight) ? '  à  ' .$showCreatureInfo->maxHeight . 'm': '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Poids</th>
                                    <td><?= $showCreatureInfo->minWeight ?>t<?= isset($showCreatureInfo->maxWeight) ? '  à  ' .$showCreatureInfo->maxWeight . 't': '' ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Prédateurs</th>
                                    <td><?= $showCreatureInfo->predatory ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alimentation</th>
                                    <td><?= $showCreatureInfo->dietName ?></td>
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
                <p class="h5 text-center">Ils ont vécu dans la même période :</p>
                <?php foreach($showCreaturesByPeriod as $crea){ ?>
                    <div><a href="creature.php?id=<?= $crea->id ?>"><img src="<?= $crea->miniImage ?>" width="100px" height="100px"  class="m-3" /></a></div>
                <?php } ?>
            </div>
        </div>
</section>
<!-- <section class="mx-1">
    <h1 class="text-center my-5 creaName">Plus de détails</h1>
    <div class="row">
        <div class="col-md-2">
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
        </div>
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
</section> -->
<!-- commentaires -->

<!-- Modal de suppression-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModal">Supprimer <?= $showCreatureInfo->name ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <i class="far fa-times-circle fa-8x text-danger"></i>
        <p class="h3">Êtes vous sûr ?</p>
        <p>Voulez-vous vraiment supprimer cette créature ? </br> Ce processus est irréversible.</p>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> 
        <a href="#" type="button" class="btn bg-danger">Supprimer</a>
    </div>
  </div>
</div>
<img src='https://img.icons8.com/ios/500/circled-up-2.png' onclick="backToTop()" class="creaName" alt='flèche' width="50px" height="50px" />
<?php include 'parts/footer.php' ?>