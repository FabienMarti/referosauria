<?php
include 'models/userModel.php';
include 'controllers/adminPanelController.php';
$rolesArray = array('1' => 'Administrateur', '2' => 'Modérateur', '3' => 'Membre');
?>
<div class="container mt-5">
    <!-- barre de recherche -->
    <form class="form-inline my-2">
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Go</button>
    </form>
    <!-- affichage des utilisateurs -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Envoyer un mail</th>
            <th scope="col">Date d'inscription</th>
            <th scope="col">Rôle</th>
            <th scope="col">Editer</th>
            <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($showUserInfo as $info) { ?>
                    <tr>
                        <th scope="row" ><?= $info->usrId  ?></th>
                        <td><?= $info->username ?></td>
                        <td><?= $info->mail ?></td>
                        <td><button class="btn btn-success mailEnvelope"><a href="mailto:<?= $info->mail ?>"><i class="fas fa-envelope"></i></a></button></td>
                        <td><?= $info->inscDate ?></td>
                        <td><?= $info->role ?></td>
                        <td><button class="btn btn-info" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></button></td>
                        <!-- ajouter une methode pour supprimer -->
                        <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                <?php } ?>
        </tbody>
      </table>
    </div>

<!-- Modal d'édition-->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editer <strong><?= $showSingleUser->username ?></strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
              <table class="table table-bordered">
                  <thead class="thead-dark">
                      <tr>
                        <th scope="col"><label for="userId">Id : </label></th>
                        <th scope="col"><label for="username">Nom d'utilisateur : </label></th>
                        <th scope="col"><label for="mail">adresse mail : </label></th>
                      </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <th scope="row"><input type="text" name="userId" id="userId" value="<?= $showSingleUser->id ?>" /></th>
                      <td><input type="text" name="username" id="username" value="<?= $showSingleUser->username ?>" /></td>
                      <td><input type="email" name="mail" id="mail" value="<?= $showSingleUser->mail ?>" /></td>
                  </tr>
                  </tbody>
              </table> 
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Modifier</button>
              </div>
            </form>
          
        </div>
        
      </div>
    </div>
</div>
</div>