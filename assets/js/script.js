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
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', 'controllers/registerCtrl.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            if(request.responseText == 1){ //Dans le cas ou la valeur dans le champ est déjà en BDD
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }else if(request.responseText == 2){ //Dans le cas où le champ est vide
                input.classList.remove('is-valid','is-invalid');
            }else{ //Dans le cas ou la valeur dans le champ n'est pas en BDD
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        };        
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('fieldValue=' + input.value + '&fieldName=' + input.name);
}