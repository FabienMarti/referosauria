<!-- Modale footer -->
    <?php include $linkModif . 'views/parts/footerModal.php' ?>
<!-- Footer -->
    <footer class="container-fluid text-white p-3">
        <div class="row text-white text-center">
            <p class="col-md-3 my-auto biggerFont"><a onclick="changeFooterModalContent(0)">Politique de confidentialité</a></p>
            <p class="col-md-3 my-auto biggerFont"><a onclick="changeFooterModalContent(1)">Conditions générales</a></p>
            <p class="col-md-3 my-auto biggerFont"><a onclick="changeFooterModalContent(2)">Accessibilité</a></p>
            <p class="col-md-3 my-auto biggerFont"><a onclick="changeFooterModalContent(3)">À propos de referosauria</a></p>
        </div>
        <p class="text-center mb-0 mt-3 biggerFont">© <?= date('Y') ?> Referosauria</p>
    </footer>
<!-- scripts -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
    <script src="<?= $linkModif ?>assets/js/script.js"></script>
    <script src="<?= $linkModif ?>assets/js/registration.js"></script>
    <script src="<?= $linkModif ?>assets/js/ajax.js"></script>

</body>
</html>