<?php 
include_once 'models/userModel.php';
include_once 'controllers/profilControllers/editPWController.php' 
?>
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