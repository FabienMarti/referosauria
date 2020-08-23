<?php 
$pageTitle = 'Panel D\'administration';
include 'parts/header.php';
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
      <table class="table table-striped table-bordered text-center">
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
                  <form action="" method="POST">
                    <tr id="userNB<?= $info->usrId ?>">
                        <th scope="row" ><?= $info->usrId ?></th>
                        <td><?= isset($_POST['btn'. $info->usrId .'']) ? '<input type="text" name="username" value="' . $info->username . '" />': $info->username ?></td>
                        <td><?= isset($_POST['btn'. $info->usrId .'']) ? '<input type="email" name="mail" value="' . $info->mail . '" />': $info->mail ?></td>
                        <td><button class="btn btn-success mailEnvelope"><a href="mailto:<?= $info->mail ?>"><i class="fas fa-envelope"></i></a></button></td>
                        <td><?= $info->inscDate ?></td>
                        <td>
                          <select name="role<?= $info->usrId ?>">
                            <option value="" disabled selected><?= $info->role ?></option>
                            <?php 
                              if(isset($_POST['btn'. $info->usrId .''])){
                                foreach ($rolesArray as $key => $value) { 
                                  ?><option value="<?= $key ?>"><?= $value ?></option>
                                <?php }
                              } ?>
                          </select>
                        </td>
                        <td><button class="btn <?= (isset($_POST['btn'. $info->usrId .''])) ? 'btn-success' : 'btn-info' ?>" name="btn<?= $info->usrId ?>"><i class="fas <?= (isset($_POST['btn'. $info->usrId .''])) ? 'fa-check' : 'fa-edit' ?>"></i></button></td>
                        <!-- ajouter une methode pour supprimer -->
                        <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                  </form>
            <?php } ?>
        </tbody>
      </table>
    </div>
</div>
<!-- test JS -->
<script>
  /* function editInfos(user, icon){
    console.log(icon);
    if(icon.classList.contains('fa-edit')){
      icon.setAttribute('class', 'fa-check');
        }else{
          icon.setAttribute('class', 'fa-edit');
        }
  } */
</script>