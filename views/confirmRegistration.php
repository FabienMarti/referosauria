<?php 
    $pageTitle = 'Confirmation d\'inscription';
    include 'views/parts/header.php';
    include 'views/parts/functions.php';
    generateBreadcrumb(array('index.php' => 'Referosauria','registration.php' => 'Inscription' , 'final' => $pageTitle));
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
<?php include 'views/parts/footer.php' ?>