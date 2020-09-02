<?php
$regexList = array('username' => '%^[A-ÿ0-9_\-]{2,30}$%', 'password' => '%^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$%');
$formErrors = array();

$user = new user();

if(isset($_POST['validateForm'])){
    
    if(count($_POST) > 0){

        if(!empty($_POST['mail'])){
            if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $user->mail = htmlspecialchars($_POST['mail']);
            }else{
                $formErrors['mail'] = MAIL_ERROR_WRONG;
            }
        }else{
            $formErrors['mail'] = MAIL_ERROR_EMPTY; 
        }

        if(!empty($_POST['confirmMail'])){
            if(filter_var($_POST['confirmMail'], FILTER_VALIDATE_EMAIL)){
                $confirmMail = htmlspecialchars($_POST['confirmMail']);
            }else{
                $formErrors['confirmMail'] = MAIL_ERROR_WRONG;
            }
        }else{
            $formErrors['confirmMail'] = MAIL_ERROR_EMPTY; 
        }

        if(!empty($_POST['username'])){
            if(preg_match($regexList['username'], $_POST['username'])){
                $user->username = htmlspecialchars($_POST['username']);
            }else{
                $formErrors['username'] = USERNAME_ERROR_WRONG;
            }
        }else{
            $formErrors['username'] = USERNAME_ERROR_EMPTY; 
        }

        if(!empty($_POST['password'])){
            if(preg_match($regexList['password'], $_POST['password'])){
                $user->pass = htmlspecialchars($_POST['password']);
            }else{
                $formErrors['password'] = PASSWORD_ERROR_WRONG;
            }
        }else{
            $formErrors['password'] = PASSWORD_ERROR_EMPTY; 
        }

        /************ PASSWORD LIVE MICKAEL *****************/
        $isPasswordOk = true;
        if(empty($_POST['password'])){
            $formErrors['password'] = PASSWORD_ERROR_EMPTY;
            $isPasswordOk = false;
        }

        if(empty($_POST['confirmPassword'])){
            $formErrors['confirmPassword'] = PASSWORDVERIFY_ERROR_EMPTY;
            $isPasswordOk = false;
        }

        if($isPasswordOk){
            if($_POST['confirmPassword'] == $_POST['password']){
                //hash du mot de passe
                $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
        }else{
            $formErrors['password'] = $formErrors['confirmPassword'] = PASSWORD_ERROR_NOTEGAL;
        }

        if(empty($formErrors)){
            $isOk = true;
            if($user->checkUnavailabilityByFieldName(['username'])){
                $formErrors['username'] = 'Le nom d\'utilisateur est déjà utilisé.';
                $isOk = false;
            }
            if($user->checkUnavailabilityByFieldName(['mail'])){
                $formErrors['mail'] = 'Lemail est deja utilisé';
                $isOk = false;
            }
            if($isOk){
                $user->addNewUser();
            }
        }


        /****************************************************************/
        if(!isset($_POST['validate'])){
            $formErrors['validate'] = 'Pour finaliser votre inscription, veuillez accepter les CGU';
        }

        if (empty($formErrors)) {
            if (!$user->checkUserExist()){
                if($user->addNewUser()){
                   $messageSuccess = 'Votre compte a bien été créé.'; 
                } else {
                    $addUserMessage = 'Une erreur est survenue.';
                }
            } else {
                $addUserMessage = 'Le nom d\'utilisateur est déjà utilisé.';
            }
        }
    }
}

/*******AJAX ******/
//traitement de la demande AJAX

if(isset($_POST['fieldValue'])){
    if(!empty($_POST['fieldValue'] && !empty($_POST['fieldName']))){
        include_once '../config.php';
        include_once '../models/users.php';
        $user = new user;
        $user->username = htmlspecialchars($_POST['field']);
        echo $user->checkUnavailabilityByFieldName([htmlspecialchars($_POST['fieldName'])]);
    }
}