<!-- Modal -->
<div class="modal fade" id="footerModal" tabindex="-1" role="dialog" aria-labelledby="footerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="footerModalLabel">Titre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Politique de confidentialité -->
        <div class="modalContent" id="privacyPolicy">
            <p>1</p>
        </div>
        <!-- Conditions Générales -->
        <div class="modalContent" id="conditions">
            <p>2</p>
        </div>
        <!-- Accessibilité -->
        <div class="modalContent" id="accessibility">
            <p>3</p>
        </div>
        <!-- À propos de referosauria -->
        <div class="modalContent" id="about">
            <p>4</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>   
<!-- Footer -->
<footer class="container-fluid bg bg-secondary mt-5 text-white">
    <div class="row text-white">
        <p class="col-md-2">© <?= date('Y') ?> Referosauria</p>
        <div class="offset-md-2 col-md-8 text-right">
            <div class="row">
                <p class="col-md-3"><a onclick="changeFooterModalContent(0)">Politique de confidentialité</a></p>
                <p class="col-md-3"><a onclick="changeFooterModalContent(1)">Conditions générales</a></p>
                <p class="col-md-3"><a onclick="changeFooterModalContent(2)">Accessibilité</a></p>
                <p class="col-md-3"><a onclick="changeFooterModalContent(3)">À propos de referosauria</a></p>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<script src="assets/js/footer.js"></script>
</body>
</html>