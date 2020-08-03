<?php
$contentArray = array('home' => 'Accueil', 'dinoList' => 'Liste des dinosaures', 'discover' => 'Découvrir', 'addDino' => 'Déposer un article', 'registration' => 'S\inscrire', 'contribute' => 'Faire un don', 'quiz' => 'Quiz', 'forum' => 'Forum', 'creature' => 'Créature');
if(isset($_GET['content'])){
    if(isset($contentArray[$_GET['content']])){
    //si la valeur 'content' existe et que sa valeur est égale à une des clés associatives et du tableau $contentArray
        if(isset($_GET['content']) && (isset($contentArray[$_GET['content']]))) {
            $pageTitle = $contentArray[$_GET['content']];
            $page = htmlspecialchars($_GET['content']);
            $content = 'views/' . $page . '.php';
        } else {
            $pageTitle = 'Accueil';
            $content = 'views/home.php';
        }
    }
}else {
    $pageTitle = 'Accueil';
    $content = 'views/home.php';
}

//Générateur de fil d'ariane semi-automatique (tableau à remplir sur chaque page)
function generateBreadcrumb($crumbsArray){?>
    <nav class="bg-light" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php
                foreach ($crumbsArray as $url => $name) {
                    //'final' représente la derniere clée du tableau, et n'est pas un lien actif
                    if($url == 'final'){
                        ?><li class="breadcrumb-item" aria-current="page"><?= $name ?></li><?php
                        break;
                    }else{
                    //créé une 'li' pour chaque entrée du tableau avec noms et urls
                    ?><li class="breadcrumb-item active"><a href="<?= $url ?>"><?= $name ?></a></li><?php
                    }   
                } 
            ?>
        </ol>
    </nav><?php 
    } ?>