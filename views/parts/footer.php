<!-- Modale Connexion -->
<?php 
include  $linkModif . 'views/parts/connectionModal.php' 
?>
<!-- Modale footer -->
    <?php include $linkModif . 'views/parts/footerModal.php' ?>
<!-- Footer -->
    <footer class="container-fluid text-white">
        <div class="row text-white text-center">
            <p class="col-md-3 my-auto"><a onclick="changeFooterModalContent(0)">Politique de confidentialité</a></p>
            <p class="col-md-3 my-auto"><a onclick="changeFooterModalContent(1)">Conditions générales</a></p>
            <p class="col-md-3 my-auto"><a onclick="changeFooterModalContent(2)">Accessibilité</a></p>
            <p class="col-md-3 my-auto"><a onclick="changeFooterModalContent(3)">À propos de referosauria</a></p>
        </div>
        <p class="text-center">© <?= date('Y') ?> Referosauria</p>
    </footer>
<!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="<?= $linkModif ?>assets/js/footer.js"></script>
</body>
</html>