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

function checkUnavailability(input){
    //XMLHttpRequest est une classe de JS
    var request = new XMLHttpRequest();
    request.open('POST', 'controllers/registrationController.php', true);
    request.onreadystatechange = function () {
    //si on a bien reçu la réponse de la page et qu'elle est bien chargée
        if (request.readyState == 4 && request.status == 200){
            if(request.responseText == 1){
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            }else if (request.responseText == 2){
                input.classList.remove('is-invalid', 'is-valid');
            }
            else{
                input.classList.add('is-valid');
                input.classList.remove('is-invalid');
            }
        }
    }
    request.setRequestHeader('content-type', 'application/x-www-form-urlencoded', );
    request.send('fieldValue=' + input.value + '&fieldName=' + input.name);
}