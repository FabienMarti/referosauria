<?php 
include_once 'models/userModel.php';
include_once 'controllers/profilControllers/deleteProfilController.php' 
?>

<?php

    if(isset($isAccountDeleted) && $isAccountDeleted == true){ ?>

        <h1 class="text-danger text-center">Votre compte à bien été supprimé</h1>
        <a href="index.php">Retour à l'accueil</a>
        



    <?php }else{ ?>
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
    <?php } ?>