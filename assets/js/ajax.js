/*************************************** FONCTIONS AJAX *********************************************/

//! Fonction vérification username avec regex

function checkRegex(input){
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', '../controllers/registrationController.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 1) { 
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else if (request.responseText == 2) { 
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-valid', 'is-invalid');
            } 
        };
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('fieldValue=' + input.value + '&fieldName=' + input.name);
}

//! Verification de la conformité du mail

function checkMail(input){
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', '../controllers/registrationController.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 1) { 
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else if (request.responseText == 2) { 
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-valid', 'is-invalid');
            } 
        };
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('mailValue=' + input.value);
}
//! Verification de la correspondance des mails

function checkVerifyMail(verifiedMailinput, mailInput) {
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', '../controllers/registrationController.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 1) { 
                verifiedMailinput.classList.remove('is-invalid');
                verifiedMailinput.classList.add('is-valid');
            } else if (request.responseText == 2) { 
                verifiedMailinput.classList.remove('is-valid');
                verifiedMailinput.classList.add('is-invalid');
            } else {
                verifiedMailinput.classList.remove('is-valid', 'is-invalid');
            } 
        };
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('verifiedMailValue=' + verifiedMailinput.value + '&emailValue=' + mailInput.value);
}

function checkPasswordWithMail(input, password, username){
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', '../controllers/connectionController.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            if (request.responseText == 1) { 
                document.getElementById('connectionForm').submit();
            } else if (request.responseText == 2) { 
                input.forEach(element => {
                    element.classList.remove('is-valid');
                    element.classList.add('is-invalid');
                });
            } else {
                input.forEach(element => {
                    element.classList.remove('is-valid', 'is-invalid'); 
                });
            } 
        };
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('passwordValue=' + password.value + '&usernameValue=' + username.value);
}