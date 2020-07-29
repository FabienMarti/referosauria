<?php
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

