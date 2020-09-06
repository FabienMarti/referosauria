//Regex
upperCaseRegex = /^(.*[A-Z].*)$/;
lowerCaseRegex = /^(.*[a-z].*)$/;
numberRegex = /^(.*[0-9].*)$/;

function checkPassword(input, str1, str2, str3, str4) {

    let strArray = [str1, str2, str3, str4];

    //! Si la Longueur de la saisie est supérieure à 0
    if (input.length > 0) {
        
        //! Longueur du champ saisi
        if (input.length > 7) {
            str1.parentNode.style.color = 'green';
            str1.style.color = 'green';
            str1.classList.remove('fa-times', 'fa-minus');
            str1.classList.add('fa-check');
        }

        else if (input.length <= 7 && input.length > 0) {
            str1.parentNode.style.color = 'red';
            str1.style.color = 'red';
            str1.classList.add('fa-times');
        }

        //! Si le champ saisi contient une majuscule
        if (upperCaseRegex.test(input)) {
            str2.parentNode.style.color = 'green';
            str2.style.color = 'green';
            str2.classList.remove('fa-times', 'fa-minus');
            str2.classList.add('fa-check');
        } else {
            str2.parentNode.style.color = 'red';
            str2.style.color = 'red';
            str2.classList.remove('fa-check', 'fa-minus');
            str2.classList.add('fa-times');
        }

        //! Si le champ saisi contient une minuscule
        if (lowerCaseRegex.test(input)) {
            str3.parentNode.style.color = 'green';
            str3.style.color = 'green';
            str3.classList.remove('fa-times', 'fa-minus');
            str3.classList.add('fa-check');
        } else {
            str3.parentNode.style.color = 'red';
            str3.style.color = 'red';
            str3.classList.remove('fa-check', 'fa-minus');
            str3.classList.add('fa-times');
        }

        //! Si le champ saisi contient un nombre
        if (numberRegex.test(input)) {
            str4.parentNode.style.color = 'green';
            str4.style.color = 'green';
            str4.classList.remove('fa-times', 'fa-minus');
            str4.classList.add('fa-check');
        } else {
            str4.parentNode.style.color = 'red';
            str4.style.color = 'red';
            str4.classList.remove('fa-check', 'fa-minus');
            str4.classList.add('fa-times');
        }
    } else { 
        strArray.forEach(str => {
            str.classList.remove('fa-times', 'fa-check');
            str.classList.add('fa-minus');
            str.parentNode.style.color = 'black';
            str.style.color = 'black';
        });
    }
}

/***************************************** JAUGE LEVEL PASSWORD ***************************************************/

//Récupere les élements dans des variables.
var password = document.getElementById('password');
var meter = document.getElementById('password-strength-meter');

//Evenement à l'input du champ password.
password.addEventListener('input', function () {
    //Stocke le mot de passe dans une variable.
    var val = password.value;
    //Utilise la bibliothèque ZXCVBN pour tester le mot de passe.
    var result = zxcvbn(val);

    //Met à jour la valeur de l'élement <meter> en fonction du résultat.
    meter.value = result.score;
});