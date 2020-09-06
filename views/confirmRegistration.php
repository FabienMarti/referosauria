<?php 
$pageTitle = 'Confirmation d\'enregistrement';
session_start();
//Défini la variable linkModif qui contiendra le préfix du lien en fonction de la position de l'utilisateur
$_SERVER['PHP_SELF'] != '/index.php' ? $linkModif = '../' : $linkModif = '';
include_once '../config.php';
include_once '../models/database.php';
include_once '../models/userModel.php';
include '../controllers/connectionController.php';
include_once '../lang/FR_FR.php';
include 'parts/header.php';
generateBreadcrumb(array('../index.php' => 'Referosauria','registration.php' => 'Inscription' , 'final' => $pageTitle));
?>
    <section>
        <h2 class="text-center"><u>Confirmation d'inscription</u></h2>
        <div class="container border border-dark p-3 rounded">
            <p>Nous venons d'envoyer un e-mail de confirmation à votre adresse</p>
            <form>
                <div class="row">
                        <div class="form-group col-4">
                        <label for="confirmationID">Numéro de confirmation</label>
                        <input type="number" id="confirmationID" name="confirmationID" placeholder="12345" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Confirmer" />
                </div>
            </form>
        </div>
        <p>Recevoir à nouveau l'email de confirmation</p>
    </section>
    <?php include 'parts/footer.php' ?>