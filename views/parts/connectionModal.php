<?php 
include_once $linkModif . 'models/userModel.php';
include $linkModif . 'controllers/connectionController.php';
?>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><u>Se connecter</u></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur : </label>
                                <input class="form-control" type="text" id="username" name="username" />
                            </div>
                            <div class="form-group">
                                <label for="pass">Mot de passe : </label>
                                <input class="form-control" type="password" id="pass" name="pass" />
                                <a href="index.php?content=passwordRecovery">Mot de passe oublié ?</a>
                            </div>
                            <div class="text-center">
                                <a href="views/login.php" type="submit" name="sendConnect" class="btn btn-primary">Connexion</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>