<?php 
$pageTitle = 'Enregistrement';
include 'parts/header.php';
include '../models/database.php';
include '../models/userModel.php';
include '../controllers/registrationController.php';
include '../controllers/breadcrumb.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => 'Inscription'));
?>
<h2 class="text-center titleStyle"><u>Inscription</u></h2>
<p><?= isset($addUserMessage) ? $addUserMessage : '' ?></p>
<?php if(isset($messageSuccess)){ ?>
    <h1 class="text-center titleStyle"><?= $messageSuccess ?></h1>
<?php }else{ ?>
<form class="container border border-dark p-3 rounded divBackColor mb-5" action="" method="POST">
    <div class="row">
        <p class="col text-right"><i class="fas fa-exclamation-triangle"></i> <span class="text-danger">*</span> = Champs obligatoire <i class="fas fa-exclamation-triangle"></i></p>
    </div>
    <div class="form-group">
            <label for="username">Nom d'utilisateur<span class="text-danger">*</span> : </label>
            <input oninput="checkRegex(this)" type="text" name="username" id="username" placeholder="Ex : DinoLOVER" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['username']) ? 'value="' . $_POST['username'] . '"' : '' ?> />
            <?php if (isset($formErrors['username'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['username'] ?></p>
            <?php } ?>
    </div>
    <!-- Mot de passe -->
    <div class="row">
        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'has-danger' : 'has-success') : '' ?>">
            <label for="password">Mot de passe<span class="text-danger">*</span> : </label>
            <input onblur="checkRegex(this)" type="text" name="password" id="password" placeholder="Ex : Aabb1234" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> />
            <?php if (isset($formErrors['password'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['password'] ?></p>
            <?php } ?>
        </div>
        <div class="form-group col">
            <label for="confirmPassword">Confirmez le mot de passe<span class="text-danger">*</span> : </label>
            <input onblur="checkRegex(this)" type="text" name="confirmPassword" id="confirmPassword" placeholder="Ex : Aabb1234" class="form-control" />
            <p class="text-danger text-center"><?= (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != $_POST['password']) ? 'Les mots de passe ne correspondent pas' : '' ?></p>
        </div>
    </div>
    <div class="row">
        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
            <label for="mail">Adresse e-mail<span class="text-danger">*</span> : </label>
            <input onblur="checkMail(this)" type="mail" id="mailInput" name="mail" id="mail" placeholder="Ex : stephane.dupont@gmail.com" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> />
                <?php if (isset($formErrors['mail'])) { ?>
                    <p class="text-danger text-center"><?= $formErrors['mail'] ?></p>
                <?php } ?>
        </div>
        <div class="form-group col">
            <label for="mailVerify">Confirmez l'adresse e-mail<span class="text-danger">*</span> : </label>
            <input onblur="checkVerifyMail(this, mailInput)" type="mail" name="mailVerify" id="mailVerify" placeholder="Ex : stephane.dupont@gmail.com" class="form-control" />
            <p class="text-danger text-center"><?= (isset($_POST['mailVerify']) && $_POST['mailVerify'] != $_POST['mail']) ? 'Les adresses e-mail ne correspondent pas' : '' ?></p>

        </div>
    </div>
    <div class="row">
        <div class="col"><input type="checkbox" name="validateCGU" id="validateCGU" />
            <label for="validateCGU">J'accepte les <a href="#">CGU.</a></label>
            <p class="text-danger"> <?= isset($formErrors['validateCGU']) ? $formErrors['validateCGU'] : '' ?> </p>
        </div>
        <div class="col text-right">
            <button class="btn" type="submit" name="validateRegistration">Valider</button>
        </div>
    </div>
</form>
<?php } ?>
<?php include 'parts/footer.php' ?>