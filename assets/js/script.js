//script modal footer
var modalContentArray = document.getElementsByClassName('modalContent');
var modalTitle = document.getElementById('footerModalLabel');

function backToTop(){
    window.scrollTo(0, 0);
}

function changeFooterModalContent(modal){
    for (let i = 0; i < modalContentArray.length; i++) {
        modalContentArray[i].style.display = 'none';
    }
    switch (modal) {
        case 0:
            modalTitle.innerHTML = 'Politique de confidentialité';
            modalContentArray[0].style.display = 'block';
        break;
        case 1:
            modalTitle.innerHTML = 'Conditions Générales';
            modalContentArray[1].style.display = 'block';
        break;
        case 2:
            modalTitle.innerHTML = 'Accessibilité';
            modalContentArray[2].style.display = 'block';
        break;
        case 3:
            modalTitle.innerHTML = 'À propos de referosauria';
            modalContentArray[3].style.display = 'block';
        break;
    }
    $('#footerModal').modal('toggle');
}

//fonction parallax sur Body
(function(){

    var parallax = document.querySelectorAll("body"),
        speed = 0.5;

    window.onscroll = function(){
        [].slice.call(parallax).forEach(function(el,i){

        var windowYOffset = window.pageYOffset,
            elBackgrounPos = "50% " + (windowYOffset * speed) + "px";

        el.style.backgroundPosition = elBackgrounPos;

        });
    };
})();

//jQuery à importer SOUS le CDN de jQuery
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('whatever');// Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-body #getId').val(recipient);
})