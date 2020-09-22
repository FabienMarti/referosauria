<?php 
$pageTitle = 'Panel d\'administration';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../models/creatureModel.php';
include '../controllers/connectionController.php';
include '../controllers/adminPanelCreatureListController.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'profil.php?id=' . $_SESSION['profile']['id'] => 'Page de profil' , 'final' => $pageTitle));

if(isset($_SESSION['profile']) && $_SESSION['profile']['roleId'] == 1){ ?>

<div class="container-fluid mt-5">
  <div class="row">
            <div class="col-md-2 m-auto border divBackColor">
               <?php include 'parts/adminNav.php' ?>
            </div>
    <!-- affichage des creatures -->
    <div class="table-responsive col">
        <form method="POST" action="adminPanelCreaturesList.php?page=1" class="form-inline my-2 col-6">
            <input class="form-control" type="search" placeholder="Rechercher" name="searchField" />
            <button class="btn btn-outline-success" type="submit" name="searchCrea">Rechercher</button>
        </form>
      <table class="table table-striped table-bordered text-center divBackColor">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Validation</th>
                <th scope="col">Voir/Modifier</th>
                <th scope="col">Date d'ajout</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($showCreaList as $info) { ?>
                  <form action="" method="POST">
                    <tr id="creaNB<?= $info->id ?>">
                        <th scope="row" ><?= $info->id ?></th>
                        <td><?= $info->name  ?></td>
                        <td><?= $info->available ?></td>
                        <td><a href="editCreature.php?id=<?= $info->id ?>" class="btn btn-success"><i class="fas fa-wrench"></i></a><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#validationModal" data-whatever="<?= $info->id ?>"><i class="far fa-clock"></i></button></td>
                        <td><?= $info->addDate ?></td>
                        <td><button type="button" class="btn btn-delete btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="<?= $info->id ?>"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                  </form>
            <?php } ?>
        </tbody>
      </table>
      <!-- PAGINATION -->
      <div class="text-center m-3">
        <?php 
            $beginPage = $page - 3;

            if($beginPage < 1){
                $beginPage = 1;
            }

            if ($page != 1){ ?>
                <a href="adminPanelCreaturesList.php?page=1" class="btn"><i class="fas fa-angle-double-left"></i></a>
                <a href="adminPanelCreaturesList.php?page=<?=($page - 1)?>" class="btn"><i class="fas fa-angle-left"></i></a><?php
            }

            if ($page > 4){ ?>
                <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a><?php 
            }

            $endPage = $page + 3;
            if($endPage > $pageNumber) {
                $endPage = $pageNumber;
            }

            for ($i = $beginPage; $i <= $endPage; $i++) {?>
                <a href="adminPanelCreaturesList.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-orange' : '' ?>"><?= $i ?></a><?php 
            } 

            if ($page < $pageNumber - 3){ ?>
                <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a>
            <?php }

            if ($page != $pageNumber){ ?>
                <a href="adminPanelCreaturesList.php?page=<?=($page + 1) ?>" class="btn"><i class="fas fa-angle-right"></i></a>
                <a href="adminPanelCreaturesList.php?page=<?= $pageNumber ?>" class="btn"><i class="fas fa-angle-double-right"></i></a>
          <?php } ?>
      </div>
    </div>
        </div>
        <!-- Modale de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Supprimer cet utilisateur ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
                <input id="getId" type="hidden" class="form-control" name="recipient-name" id="recipient-name" />
            <div class="form-group">
                <p class="text-center">Voulez-vous vraiment supprimer cet utilisateur ?<br>Cette action est irréversible !</p>
            </div>
            <div class="text-center">
                <input type="submit" name="deleteCrea" value="Supprimer" class="btn btn-danger" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Validation Modale -->
 <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">Valider</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <input type="hidden" class="form-control" name="recipient-name2" id="recipient-name2" value="">
            <h1>Voulez-vous valider cette créature ?</h1>
            <input type="submit" class="btn btn-primary" name="validateCrea" value="Valider la créature" />
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
    <?php include 'parts/redirect.php' ?> 
<?php } ?>
<?php include 'parts/footer.php' ?>