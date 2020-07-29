<?php
    session_start();
    switch ($_SESSION['status']) {
    case 'On':
        ?><a class="btn btn-primary" href="views/parts/logout.php">Déconnexion</a><?php
    break;
    default:
        ?><a class="btn btn-primary text-white" data-toggle="modal" data-target="#exampleModalCenter">Connexion</a><?php
}
?>
<!-- ouvre connexion si non connecté(à faire) -->
<button class="btn btn-primary">Mon profil</button><?php
echo var_dump($_SESSION['status']);
?>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    FORMULAIRE
                </div>
                <div class="modal-footer">
                    <a href="views/parts/login.php" type="button" class="btn btn-primary">Connexion</a>
                </div>
                </div>
            </div>
        </div>
        