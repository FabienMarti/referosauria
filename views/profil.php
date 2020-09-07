<?php 
$pageTitle = 'Page de profil';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/profilController.php';
include '../controllers/connectionController.php';
include '../controllers/breadcrumb.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<div class="container">
    <div class="row mt-5 justify-content-around">
        <!-- Sommaire de gauche -->
        <nav id="profilNav" class="col-3 border border-dark divBackColor">
            <p class="text-center h4">Bonjour <?= $showLightUserInfo->username ?></p>
            <p>Vous êtes inscrits depuis le : </br><?= $showLightUserInfo->inscDate ?></p>
            <p><?= $_SESSION['profile']['role'] ?></p>
            <ul class="p-2">
                <?php
                    foreach ($profilOptions as $link => $title){
                        if($title == 'Panel d\'administration'){
                        ?><li><a href="<?= $link ?>.php?page=1"><?= $title ?></a></li><?php
                        }
                        else if($title == 'Supprimer le compte'){
                        ?><li><a href="<?= $link ?>" class="btn btn-delete"><?= $title ?></a></li><?php
                        }
                        else if($title == 'Déconnexion'){
                        ?><li><a href="<?= $link ?>" class="text-danger"><?= $title ?></a></li><?php
                        }
                        else{
                        ?><li><a href="profil.php?id=<?= $_SESSION['profile']['id'] ?>&page=<?= $link ?>"><?= $title ?></a></li><?php 
                        }
                    }
                ?>
            </ul>
        </nav>
        <!-- Contenu changeant en fonction du menu selectionné -->
        <section class="col-8 border border-dark p-5 divBackColor">
            <div class="<?= isset($_GET['page']) ? ($_GET['page'] == 'deleteProfil' ? 'd-block' : 'd-none') : '' ?>">
                <form action="" method="POST">
                    <h2 class="text-center">Suppression de compte</h2>
                    <p>Cette action est irréversible, si vous décidez de supprimer votre compte, vous perdrez toutes les données associées à celui-ci.</p>
                    <p class="text-center text-success"><?= isset($pwEditSuccess) ? $pwEditSuccess : '' ?></p>
                    <div class="form-group <?= count($_POST) > 0 ? (isset($deleteProfilErrors['pass']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="pass">Tapez votre mot de passe : </label>
                        <input type="password" name="pass" id="pass" class="form-control <?= count($_POST) > 0 ? (isset($deleteProfilErrors['pass']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                            <?php if (isset($deletedeleteProfilErrors['pass'])) { ?>
                                <p class="text-danger text-center"><?= $deleteProfilErrors['pass'] ?></p>
                            <?php } ?>
                    </div>
                    <div class="form-group <?= count($_POST) > 0 ? (isset($deleteProfilErrors['deleteTXT']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="deleteTXT">Tapez : <u>'Supprimer'</u> : </label>
                        <input type="text" name="deleteTXT" id="deleteTXT" class="form-control <?= count($_POST) > 0 ? (isset($deleteProfilErrors['deleteTXT']) ? 'is-invalid' : 'is-valid') : '' ?>"/>
                            <?php if (isset($deleteProfilErrors['deleteTXT'])) { ?>
                                <p class="text-danger text-center"><?= $deleteProfilErrors['deleteTXT'] ?></p>
                            <?php } ?>
                    </div>
                    <div class="form-group text-center <?= count($_POST) > 0 ? (isset($deleteProfilErrors['check']) ? 'has-danger' : 'has-success') : '' ?>">
                        <input type="checkbox" name="check" id="check" class="<?= count($_POST) > 0 ? (isset($deleteProfilErrors['check']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                            <?php if (isset($deleteProfilErrors['check'])) { ?>
                                <p class="text-danger text-center"><?= $deleteProfilErrors['check'] ?></p>
                            <?php } ?>
                        <label for="check">J'accepte de supprimer mon compte et de perdre toutes les données associées.</label>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-danger" value="Supprimer mon compte" name="validateDelete" />
                    </div>
                </form>
            </div>
            <div class="<?= isset($_GET['page']) ? ($_GET['page'] == 'editPW' ? 'd-block' : 'd-none') : '' ?>">
                <form action="" method="POST">
                    <p class="text-center text-success"><?= isset($pwEditSuccess) ? $pwEditSuccess : '' ?></p>
                        <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['oldPW']) ? 'has-danger' : 'has-success') : '' ?>">
                            <label for="oldPW">Ancien mot de passe : </label>
                            <input type="text" name="oldPW" id="oldPW" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['oldPW']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['oldPW']) ? 'value="' . $_POST['oldPW'] . '"' : '' ?> />
                                <?php if (isset($profilErrors['oldPW'])) { ?>
                                    <p class="text-danger text-center"><?= $profilErrors['oldPW'] ?></p>
                                <?php } ?>
                        </div>
                        <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['newPW']) ? 'has-danger' : 'has-success') : '' ?>">
                            <label for="newPW">Nouveau mot de passe : </label>
                            <input type="text" name="newPW" id="newPW" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['newPW']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['newPW']) ? 'value="' . $_POST['newPW'] . '"' : '' ?> />
                                <?php if (isset($profilErrors['newPW'])) { ?>
                                    <p class="text-danger text-center"><?= $profilErrors['newPW'] ?></p>
                                <?php } ?>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Modifier" name="validateEdit" />
                        </div>
                    </form>
                <a href="index.php?content=passwordRecovery">Mot de passe oublié ?</a>
            </div>
            <div class="<?= isset($_GET['page']) ? ($_GET['page'] == 'infos' ? 'd-block' : 'd-none') : '' ?>">
                <p class="text-center text-success"><?= isset($succesEdit) ? $succesEdit : '' ?></p>
                <form action="" method="POST">
                    <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['username']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="username">Pseudonyme : </label>
                        <input type="text" name="username" id="username" value="<?= isset($_POST['username']) ? $_POST['username'] : $showLightUserInfo->username ?>" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                            <?php if (isset($profilErrors['username'])) { ?>
                                <p class="text-danger text-center"><?= $profilErrors['username'] ?></p>
                            <?php } ?>
                    <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
                        <label for="mail">Adresse mail : </label>
                        <input type="email" name="mail" id="mail" value="<?= isset($_POST['username']) ? $_POST['username'] : $showLightUserInfo->mail ?>" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" />
                            <?php if (isset($profilErrors['mail'])) { ?>
                                <p class="text-danger text-center"><?= $profilErrors['mail'] ?></p>
                            <?php } ?>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="Modifier" name="validateInfoEdit" />
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<?php include 'parts/footer.php' ?>