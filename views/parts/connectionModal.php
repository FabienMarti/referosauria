<?php 
include_once $linkModif . 'models/userModel.php';
include $linkModif . 'controllers/connectionController.php';
?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title creaName" id="exampleModalLongTitle"><u>Se connecter</u></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body divBackColor">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur : </label>
                                <input type="text" id="username" name="username" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['username']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['username']) ? 'value="' . $_POST['username'] . '"' : '' ?> />
                                    <?php if (isset($formErrors['username'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['username'] ?></p>
                                    <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe : </label>
                                <input type="password" id="password" name="password" class="form-control <?= count($_POST) > 0 ? (isset($formErrors['password']) ? 'is-invalid' : 'is-valid') : '' ?>" <?= isset($_POST['password']) ? 'value="' . $_POST['password'] . '"' : '' ?> />
                                    <?php if (isset($formErrors['password'])) { ?>
                                        <p class="text-danger text-center"><?= $formErrors['password'] ?></p>
                                    <?php } ?>
                                <a href="<?= $linkModif ?>passwordRecovery.php">Mot de passe oublié ?</a>
                            </div>
                            <div class="text-center">
                                <input type="submit" name="login" class="btn btn-primary" value="Connexion" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>