<?php
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../models/userModel.php';
include_once '../models/commentModel.php';
include '../models/creatureModel.php';
include '../controllers/creatureController.php';
$pageTitle =  $showCreatureInfo->name; 
include '../controllers/connectionController.php';
include '../controllers/breadcrumb.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'dinoList.php?page=1' => 'Liste des dinosaures', 'final' => $showCreatureInfo->name));

if($showCreatureInfo->available == 'Validé'){ ?>
    <section class="container-fluid my-2 divBackColor py-2">
            <div class="row">
                <h1 class="text-center titleStyleShadow col"><?= $showCreatureInfo->name ?></h1>
                <?php 
                    if(isset($_SESSION['profile']) && $_SESSION['profile']['roleId'] != 1) { ?>
                        <div class="dropdown dropleft float-left my-auto">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cog"></i></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="editCreature.php?id=<?= $showCreatureInfo->id ?>"><i class="fas fa-wrench"></i> Modifier</a>
                                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash-alt"></i> Supprimer créature</a>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <div class="row justify-content-around">
                <!-- Carte + Last Threads -->
                <div class="col-md-2 text-center divBackColor p-3">
                    <p class="h5 text-center">Où a-t-on trouvé <?= $showCreatureInfo->name ?> ?</p>
                    <img src="<?= '../assets/img/local/' . $areaMap . '.jpg' ?>" class="img-fluid" />
                    <p class="h5 mt-5">Derniers sujets en rapport :</p>
                    <ul class="" id="recentPostList">
                        <li><a href="#">Le tyrannosaure pouvait-il voler ?</a></li>
                        <li>12/05/2020</li>
                        <li><a href="#">Les films avec un ou des tyrannosaures</a></li>
                        <li>05/02/2020</li>
                        <li><a href="#">Sa mangé quoi un tyronasaure ??</a></li>
                        <li>28/01/2020</li>
                    </ul>
                </div>
                <!-- Tableau des spécifications -->
                <div class="col-md-2 p-0 m-auto">
                    <table class="table table-dark text-dark table-bordered divBackColor">
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
                <!-- Image principale -->
                <div class="col-md-6 text-center p-0 m-auto">
                    <img class="img-fluid rounded" src="../<?= $showCreatureInfo->mainImage ?>" /> 
                </div>
                <!-- Ont vécus à la même période -->
                <div class="col-md-1 text-center divBackColor">
                    <p class="text-center p-3 h5"><?= $showCreatureInfo->perName ?></p>
                    <?php foreach($showCreaturesByPeriod as $crea){ ?>
                        <div><a href="creature.php?id=<?= $crea->id ?>"><img src="<?= $crea->miniImage ?>" width="100px" height="100px"  class="m-3 rounded-circle" /></a></div>
                    <?php } ?>
                </div>
                <!-- Description -->
                <div class="col-md-12 mt-2 divBackColor rounded p-3">
                    <p class="h1 text-center titleStyleShadow">Description</p>
                    <p class="text-justify"><?= $showCreatureInfo->description ?></p>
                    <p class="text-right">Source : WIKIPEDIA</p>
                </div>
            </div>
    </section>
    <?php if(isset($formErrors['comment'])){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $formErrors['comment'] ?>
        </div>
    <?php } ?>
    <!-- commentaires -->
    <section class="container" id="comments">
        <div class="divBackColor rounded border mt-5 p-3">
            <?php if(isset($_SESSION['profile'])){ ?>
                <h2>Laisser un commentaire</h2>
                <form action="<?= $_SERVER['REQUEST_URI'] . '#comments' ?>" method="POST">
                    <div class="form-group">
                        <label for="comment">Message :</label>
                        <div class="row justify-content-around">
                            <input type="text" name="comment" id="comment" placeholder="Votre message ..." class="form-control col-9" />
                            <input type="submit" name="sendComment" id="sendComment" value="Commenter" class="btn btn-primary col-2" />
                        </div>
                    </div>
                </form> 
            <?php } ?>
            <!-- Affichage des commentaires en fonction de la date d'ajout et de l'id creature -->
            <table class="table table-striped" id="commTable">
                <tbody>
                    <?php 
                    if(isset($showCreaComments)){
                        foreach ($showCreaComments as $com) { ?>
                            <tr class="row justify-content-around">
                                <th scope="row" class="col-3 p-1">
                                    <ul>
                                        <li class="text-left"><?= $com->username ?></li>
                                        <li class="text-right">Le <?= $com->comDate ?> à <?= $com->comHour ?></li>
                                    </ul>
                                </th>
                                <td class="bg-white col-7 my-auto"><?= $com->content ?></td>
                            </tr>
                    <?php } 
                    } ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- FIN Ajout de commentaire -->
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
    </div>
    <img src='https://img.icons8.com/ios/500/circled-up-2.png' onclick="backToTop()" class="creaName" alt='flèche' width="50px" height="50px" />
     
 <?php } else{ 
     include 'creaNoValidated.php';
 } ?>

<?php include 'parts/footer.php' ?>