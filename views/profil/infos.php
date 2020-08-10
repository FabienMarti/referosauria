<?php 
include_once 'models/userModel.php';
include_once 'controllers/profilControllers/infosController.php' 
?>
<p class="text-center text-success"><?= isset($succesEdit) ? $succesEdit : '' ?></p>
<form action="" method="POST">
    <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['username']) ? 'has-danger' : 'has-success') : '' ?>">
        <label for="username">Pseudonyme : </label>
        <input type="text" name="username" id="username" value="<?= $showUserInfo->username ?>" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['username']) ? 'value="' . $_POST['username'] . '"' : '' ?> />
            <?php if (isset($profilErrors['username'])) { ?>
                <p class="text-danger text-center"><?= $profilErrors['username'] ?></p>
            <?php } ?>
    <div class="form-group <?= count($_POST) > 0 ? (isset($profilErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
        <label for="mail">Adresse mail : </label>
        <input type="email" name="mail" id="mail" value="<?= $showUserInfo->mail ?>" class="form-control <?= count($_POST) > 0 ? (isset($profilErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> />
            <?php if (isset($profilErrors['mail'])) { ?>
                <p class="text-danger text-center"><?= $profilErrors['mail'] ?></p>
            <?php } ?>
    </div>
    <div class="form-group text-center">
        <input type="submit" class="btn btn-primary" value="Modifier" name="validateInfoEdit" />
    </div>
</form>