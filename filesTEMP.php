<?php
    $formError = array();   //déclation du tableau d'erreurs
    $civilityList = array('Monsieur' => 'Mr','Madame' => 'Mme');
    $regexName = '/^([A-Z]?[a-zÀ-ÖØ-öø-ÿ]+)([- ]{1}[A-Z]?[a-zÀ-ÖØ-öø-ÿ]+)*$/' ;
    $extensionsWhiteList = array('pdf', 'doc', 'docx');

    //request traiter les formulaire en get et post
    //si le formulaire est validé
    if (isset($_REQUEST['filesForm'])) {
        //si civilité n'est pas vide et que civilityr ce trouve dans le tableau
        if (!empty($_REQUEST['civility'])) {
            if (in_array($_REQUEST['civility'], $civilityList)) {
                $civility = htmlspecialchars($_REQUEST['civility']);
            }else {
                $formError['civility'] = 'Une erreur est survenue';
            }
        }else {
            $formError['civility'] = 'veuillez sélectionner une civilitée';
        }

        if (!empty($_REQUEST['firstname'])) {
            //si firstname n'est pas vide et que firstname corespond a la regex
            if (preg_match($regexName, $_REQUEST['firstname'])) {
                $firstname = htmlspecialchars($_REQUEST['firstname']);
            }else {
                $formError['firstname'] = 'Le prenom ne doit pas contenir de chiffre ou caractère spéciaux';
            }
        }else {
            $formError['firstname'] = 'veuillez saisr un prénom';
        }

        if (!empty($_REQUEST['lastname'])) {
            //si lastname n'est pas vide et que lastname corespond a la regex
            if (preg_match($regexName, $_REQUEST['lastname'])) {
                $lastname = htmlspecialchars($_REQUEST['lastname']);
            }else {
                $formError['lastname'] = 'Le nom ne doit pas contenir de chiffre ou caractère spéciaux';
            }
        }else {
            $formError['lastname'] = 'veuillez saisir un nom';
        }

        if (isset($_FILES['sendFile'])) {
            $extensionUpload = pathinfo($_FILES['sendFile']['name'], PATHINFO_EXTENSION); // recupere le nom du fichier
            //test si l'element extention upload se trouve dans le tableau extention autoriser
            if (in_array(strtolower($extensionUpload), $extensionsWhiteList)){
                $sendFile =  'Vous avez envoyer ' . $_FILES['sendFile']['name'] . ' Il s\'agit d\'un fichier .' . $extensionUpload;
            }else {
                $formError['sendFile'] = 'Les formats acceptés sont : ' . implode(', ', $extensionsWhiteList);
            }
        }else {
            $formError['sendFile'] = 'Veuillez sélectioner un fichier';
        }
    }
?>
<!-- VUE -->
<?php include 'indexController.php'; ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>partie 7 exercice 8</title>
        <style>
            form {
                display: flex;
                flex-direction: column;
                width: 50%;
                margin: 0 auto;
            }
            label, #sendFile {
                margin-top: 10px;
            }
            #firstname, #lastname {
                border: 0px;
                border-bottom: 1px Solid black;
            }
            #sendBtn {
                width: 10%;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
    <?php 
        //si le formulaire est validé et qu'il n y a pas d erreurs
        if(isset($_REQUEST['filesForm']) && count($formError) == 0) { ?>
            <p><?= 'bonjour ' . $civility . ' ' . $firstname . ' ' . $lastname ?></p>
            <p><?= $sendFile ?></p></P>
        <?php
        }else { ?>
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <label for="civility"> Civilité :
                    <select name="civility" id="civilite">
                        <?php 
                        foreach($civilityList as $civilityName => $civilityValue) { ?>
                            <option <?= isset($_REQUEST['civility']) && $_REQUEST['civility'] == $civilityValue ? 'selected' : '' ?> value="<?= $civilityValue ?>"><?= $civilityName ?></option>
                        <?php } ?>
                    </select>
                    </label>
                    <p><?= isset($formError['civility']) ? $formError['civility'] : '' ?></p>
                    <label for="firstname">Prénom : <input type="text" id="firstname" name="firstname" /></label>
                    <p><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p>
                    <label for="lastname">Nom : <input type="text" id="lastname" name="lastname" /></label>
                    <p><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p>
                    <input type="file" name="sendFile" id="sendFile" />
                    <p><?= isset($formError['sendFile']) ? $formError['sendFile'] : '' ?></p>
                    <input type="submit" id="sendBtn" name="filesForm" />
                </form>
        <?php  } ?>
    </body>
</html>