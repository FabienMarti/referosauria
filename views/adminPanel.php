<?php 
$pageTitle = 'Panel d\'administration';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/connectionController.php';
include '../controllers/adminPanelController.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'profil.php?id=' . $_SESSION['profile']['id'] => 'Page de profil' , 'final' => $pageTitle));
?>
<div class="container mt-5">
    <!-- barre de recherche -->
    <div class="row">
        <form method="POST" action="adminPanel.php?page=1" class="form-inline my-2 col-6">
            <input class="form-control" type="search" placeholder="Rechercher" name="searchField" />
            <button class="btn btn-outline-success" type="submit" name="searchUser">Rechercher</button>
        </form>
        <div class="offset-5 col-1 form-group my-auto">
             <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                <select name="nbItems" id="nbItems" class="form-control" onchange="this.form.submit()">
                    <?php
                        foreach ($itemsPerPage as $nb) { ?>
                            <option value="<?= $nb ?>" <?= isset($_POST['nbItems']) ? ($_POST['nbItems'] == $nb ? 'selected' : '') : '' ?>><?= $nb ?></option>
                        <?php } ?>
                </select>
            </form>
        </div>
    </div>
    <!-- affichage des utilisateurs -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered text-center divBackColor">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Envoyer un mail</th>
                <th scope="col">Date d'inscription</th>
                <th scope="col">Rôle</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($showUserInfo as $info) { ?>
                  <form action="" method="POST">
                    <tr id="userNB<?= $info->usrId ?>">
                        <th scope="row" ><?= $info->usrId ?></th>
                        <td><?= $info->username  ?></td>
                        <td><?= $info->mail ?></td>
                        <td><a class="btn btn-success mailEnvelope"  href="adminMailTo.php?id=<?= $info->usrId ?>"><i class="fas fa-envelope"></i></a></td>
                        <td><?= $info->inscDate ?></td>
                        <td><?= $info->role ?></td>
                        <td><button type="button" class="btn btn-delete btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="<?= $info->usrId ?>"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                  </form>
            <?php } ?>
        </tbody>
      </table>
    </div>
</div>
<div class="text-center m-3">
    <!-- Affiche le numero des page -->
    <?php 
        $beginPage = $page - 3;

        if($beginPage < 1){
            $beginPage = 1;
        }

        if ($page != 1){ ?>
            <a href="adminPanel.php?page=1" class="btn"><i class="fas fa-angle-double-left"></i></a>
            <a href="adminPanel.php?page=<?=($page - 1)?>" class="btn"><i class="fas fa-angle-left"></i></a><?php
        }

        if ($page > 4){ ?>
            <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a><?php 
        }

        $endPage = $page + 3;
        if($endPage > $pageNumber) {
            $endPage = $pageNumber;
        }

        for ($i = $beginPage; $i <= $endPage; $i++) {?>
            <a href="adminPanel.php?page=<?= $i ?>" class="btn <?= $i == $_GET['page'] ? 'btn-danger' : '' ?>"><?= $i ?></a><?php 
        } 

        if ($page < $pageNumber - 3){ ?>
            <a href="#" class="btn"><i class="fas fa-ellipsis-h"></i></a>
        <?php }

        if ($page != $pageNumber){ ?>
            <a href="adminPanel.php?page=<?=($page + 1) ?>" class="btn"><i class="fas fa-angle-right"></i></a>
            <a href="adminPanel.php?page=<?= $pageNumber ?>" class="btn"><i class="fas fa-angle-double-right"></i></a>
        <?php } ?>
</div>
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
                <input type="submit" name="deleteProfil" value="Supprimer" class="btn btn-danger" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'parts/footer.php' ?>