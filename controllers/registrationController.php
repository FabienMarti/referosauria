<?php
//tableau de regex
$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$%');

//tableau d'erreurs
$formErrors = array();



if(isset($_POST['validateRegistration'])){
    $user = new user();

    //! USERNAME 

    if(!empty($_POST['username'])){
            if(preg_match($regexList['username'], $_POST['username'])){
                //Hydratation
                $user->username = htmlspecialchars($_POST['username']);
            }else{
                $formErrors['username'] = USERNAME_ERROR_WRONG;
            }
        }else{
            $formErrors['username'] = USERNAME_ERROR_EMPTY; 
        }

    //! ADRESSE MAIL

    $isMailOk = true;
    //Si $_POST['mail'] est vide, on retourne $isMailOk false.
    if(empty($_POST['mail'])){
        $formErrors['mail'] = MAIL_ERROR_EMPTY;
        $isMailOk = false;
    }
    if(empty($_POST['mailVerify'])){
        $formErrors['mailVerify'] = MAILVERIFY_ERROR_EMPTY;
        $isMailOk = false;
    }
    //Si $isMailOk est true
    if($isMailOk){
        if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            //Si $_POST['mailVerify'] est égal à $_POST['mail'].
            if($_POST['mailVerify'] == $_POST['mail']){
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $formErrors['mail'] = MAIL_ERROR_NOTEQUAL;
            }
        }else{
            $formErrors['mail'] = $formErrors['mailVerify'] = MAIL_ERROR_WRONG;
        } 
    }

    //! MOT DE PASSE
    //? VALIDE
    $isPasswordOk = true;
    //Si $_POST['password'] est vide, on retourne $isPasswordOk false.
    if(empty($_POST['password'])){
        $formErrors['password'] = PASSWORD_ERROR_EMPTY;
        $isPasswordOk = false;
    }
    if(empty($_POST['confirmPassword'])){
        $formErrors['confirmPassword'] = PASSWORDVERIFY_ERROR_EMPTY;
        $isPasswordOk = false;
    }
    //Si $isPasswordOk est true
    if($isPasswordOk){
        //Si $_POST['password'] correspond à notre Regex pour mots de passe.
        if(preg_match($regexList['password'], $_POST['password'])){
            //Si $_POST['confirmPassword'] est égal à $_POST['password'].
            if($_POST['confirmPassword'] == $_POST['password']){
                //On hash le mot de passe pour garantir la sécurité des données de notre utilisateur.
                $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $formErrors['password'] = $formErrors['confirmPassword'] = PASSWORD_ERROR_NOTEGAL;
            }
        }else{
            $formErrors['password'] = $formErrors['confirmPassword'] = PASSWORD_ERROR_WRONG;
        }
    }

    if(!isset($_POST['validateCGU'])){
        $formErrors['validateCGU'] = CGU_ERROR_UNCHECKED;
    }

    //! VALIDATION FINALE
    //Si notre tableau d'erreurs est vide.
    if(empty($formErrors)){
        $isOk = true;
        //On vérifie si le l'username choisi est libre.
        if($user->checkUserUnavailabilityByFieldName(['username'])){
            $formErrors['username'] = USERNAME_ERROR_ALREADYUSED;
            $isOk = false;
        }
        //On vérifie si le mail renseigné est libre.
        if($user->checkUserUnavailabilityByFieldName(['mail'])){
            $formErrors['mail'] = MAIL_ERROR_ALREADYUSED;
            $isOk = false;
        }
        //Si $isOk est true
        if($isOk){
            $user->addUser();
        }
    }
}

/***************************************************************** AJAX *****************************************************************/

//Traitement de la demande AJAX => Correspondance Regex, 'password' et 'username'
if(isset($_POST['fieldValue'])){
    //On vérifie que l'on a bien envoyé des données en POST
    if(!empty($_POST['fieldName']) && !empty($_POST['fieldValue'])){
        //On inclut les bons fichiers car dans ce contexte ils ne sont pas connu.
        include_once '../config.php';
        include_once '../models/userModel.php';
        $inputName = htmlspecialchars($_POST['fieldName']);
        $inputValue = htmlspecialchars($_POST['fieldValue']);
        //Le echo sert à envoyer la réponse au JS
        if(preg_match($regexList[$inputName], $inputValue)){
            echo 1;
        }else{
            echo 2;
        }
    }
}

//Traitement de la demande AJAX => Correspondance MAIL & filter_var
if(isset($_POST['mailValue'])){
    //On vérifie que l'on a bien envoyé des données en POST
    if(!empty($_POST['mailValue'])){
        //On inclut les bons fichiers car dans ce contexte ils ne sont pas connu.
        include_once '../config.php';
        include_once '../models/userModel.php';
        $inputValue = htmlspecialchars($_POST['mailValue']);
        //Le echo sert à envoyer la réponse au JS
        if(filter_var($inputValue, FILTER_VALIDATE_EMAIL)){
            echo 1;
        }else{
            echo 2;
        }
    }
}

//Traitement de la demande AJAX => Correspondance MAILS & MAILVERIF
if(isset($_POST['verifiedMailValue'])){
    //On vérifie que l'on a bien envoyé des données en POST
    if(!empty($_POST['verifiedMailValue'])){
        //On inclut les bons fichiers car dans ce contexte ils ne sont pas connu.
        include_once '../config.php';
        include_once '../models/userModel.php';
        $inputMail = htmlspecialchars($_POST['emailValue']);
        $inputValue = htmlspecialchars($_POST['verifiedMailValue']);
        //Le echo sert à envoyer la réponse au JS
        if($inputValue == $inputMail){
            echo 1;
        }else{
            echo 2;
        }
    }
}