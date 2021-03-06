<?php 
$pageTitle = 'Enregistrement';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include_once '../lang/FR_FR.php';
include '../controllers/registrationController.php';
include '../controllers/breadcrumb.php';
include '../controllers/connectionController.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => 'Inscription'));

// Message de succes
if(isset($messageSuccess)){ ?>
    <div class="alert alert-success" role="alert">
        <?= $messageSuccess ?>
    </div>
<?php } 
if(isset($messageFail)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $messageFail ?>
    </div>
<?php } ?>
<!-- Formulaire d'inscription -->
<form class="container border border-dark p-3 rounded divBackColor my-5" action="registration.php" method="POST">
<h2 class="text-center titleStyle"><u>Inscription</u></h2>
    <div class="row">
        <p class="col text-right"><i class="fas fa-exclamation-triangle"></i> <span class="text-danger">*</span> = Champs obligatoire <i class="fas fa-exclamation-triangle"></i></p>
    </div>
    <!-- Nom d'utilisateur -->
    <div class="form-group">
        <label for="username">Nom d'utilisateur<span class="text-danger">*</span> : </label>
        <input oninput="checkRegex(this)" type="text" name="username" id="username" placeholder="Ex : DinoLOVER" class="form-control <?= isset($_POST['validateRegistration']) && count($formErrors) > 0 ? (isset($formErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['username']) ? 'value="' . $_POST['username'] . '"' : '' ?> />
        <?php if (isset($formErrors['username'])) { ?>
            <p class="text-danger text-center"><?= $formErrors['username'] ?></p>
        <?php } ?>
    </div>
    <!-- Mot de passe -->
    <div class="row">
        <div class="form-group col-12 col-md-6 <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'has-danger' : 'has-success') : '' ?>">
            <label for="password">Mot de passe<span class="text-danger">*</span> : </label>
            <div>
                <input onblur="checkRegex(this)" onkeyup="checkPassword(this.value, charLength, upperCase, lowerCase, charNumber)" type="password" name="password" id="password" placeholder="Ex : Aabb1234" class="form-control <?= isset($_POST['validateRegistration']) && count($_POST) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> />
                <i onclick="showPassword(this, document.getElementById('password'))" class="fieldIcon fas fa-eye-slash"></i>
            </div>
            <meter class="m-0 w-100" max="4" id="password-strength-meter"></meter>
            <?php if (isset($formErrors['password'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['password'] ?></p>
            <?php } ?>
        </div>
        <!-- Vérification du mot de passe -->
        <div class="form-group col-12 col-md-6">
            <label for="confirmPassword">Confirmez le mot de passe<span class="text-danger">*</span> : </label>
            <input onblur="verifFields(document.getElementById('password'), this)" type="password" name="confirmPassword" id="confirmPassword" placeholder="Ex : Aabb1234" class="form-control  <?= isset($_POST['validateRegistration']) && count($_POST) > 0 ? (isset($formErrors['confirmPassword']) ? 'is-invalid' : 'is-valid') : '' ?>"" />
            <p class="text-danger text-center"><?= (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != $_POST['password']) ? 'Les mots de passe ne correspondent pas' : '' ?></p>
            <?php if (isset($formErrors['confirmPassword'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['confirmPassword'] ?></p>
            <?php } ?>
        </div>
    </div>
        <ul class="noListStyle list-inline">
            <li><i id="charLength" class="fas fa-minus"></i> Au moins 8 caractères.</li>
            <li><i id="upperCase" class="fas fa-minus"></i> Au moins une lettre en majuscule.</li>
            <li><i id="lowerCase" class="fas fa-minus"></i> Au moins une lettre en minuscule.</li>
            <li><i id="charNumber" class="fas fa-minus"></i> Au moins un chiffre.</li>
        </ul>
    <div class="row">
        <!-- Adresse mail -->
        <div class="form-group col <?= count($_POST) > 0 ? (isset($formErrors['mail']) ? 'has-danger' : 'has-success') : '' ?>">
            <label for="mail">Adresse e-mail<span class="text-danger">*</span> : </label>
            <input onblur="checkMail(this)" type="mail" id="mail" name="mail" id="mail" placeholder="Ex : stephane.dupont@gmail.com" class="form-control <?= isset($_POST['validateRegistration']) && count($_POST) > 0 ? (isset($formErrors['mail']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['mail']) ? 'value="' . $_POST['mail'] . '"' : '' ?> />
                <?php if (isset($formErrors['mail'])) { ?>
                    <p class="text-danger text-center"><?= $formErrors['mail'] ?></p>
                <?php } ?>
        </div>
        <!-- Vérification de l'adresse mail -->
        <div class="form-group col">
            <label for="mailVerify">Confirmez l'adresse e-mail<span class="text-danger">*</span> : </label>
            <input onblur="verifFields(document.getElementById('mail'), this)" type="mail" name="mailVerify" id="mailVerify" placeholder="Ex : stephane.dupont@gmail.com" class="form-control <?= isset($_POST['validateRegistration']) && count($_POST) > 0 ? (isset($formErrors['mailVerify']) ? 'is-invalid' : 'is-valid') : '' ?>"" />
            <p class="text-danger text-center"><?= (isset($_POST['mailVerify']) && $_POST['mailVerify'] != $_POST['mail']) ? 'Les adresses e-mail ne correspondent pas' : '' ?></p>
            <?php if (isset($formErrors['mailVerify'])) { ?>
                <p class="text-danger text-center"><?= $formErrors['mailVerify'] ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <!-- Validation des CGU -->
        <div class="col">
            <input type="checkbox" name="validateCGU" id="validateCGU" />
            <label for="validateCGU">J'accepte les <a href="#">CGU.</a></label>
            <p class="text-danger"><?= isset($formErrors['validateCGU']) ? $formErrors['validateCGU'] : '' ?></p>
        </div>
        <!-- Bouton pour valider le formulaire -->
        <div class="col text-right">
            <button class="btn" type="submit" name="validateRegistration">Valider</button>
        </div>
    </div>
</form>
<?php include 'parts/footer.php' ?>