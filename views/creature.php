<?php
    //récupération de la BDD dans une variable
    $bdd = new PDO('mysql:host=localhost;dbname=referosauria', 'root', '');
    //selection de la créature via l'id
    $id = 1;
    //requete (query)
    $response = $bdd->query('SELECT * FROM creatures WHERE id=' . $id);
    //fetch = rapporter, on demande a la fonction d'aller chercher les données
    $data = $response->fetch();
    //request pour le titre avec la BDD
    $pageTitle = $data['titre'];
    include 'views/parts/header.php';
    include 'views/parts/functions.php';
    generateBreadcrumb(array('index.php' => 'Referosauria', 'dinoList.php' => 'Liste des dinosaures', 'final' => $pageTitle)); 
?>
<section class="container-fluid my-2">
        <h1 class="text-center my-5"><u><?= $data['titre'] ?></u></h1>
        <div class="row">
            <div class="col-md-2 text-center border">
                <p class="h6 text-center">Où a-t-on trouvé Tyrannosaure ?</p>
                <img src="assets/img/localTyrannosaurus.png" class="img-fluid" />
                <p class="h5 mt-5">Derniers sujets en rapport :</p>
                <ul class="border" id="recentPostList">
                    <li><a href="#">Le tyrannosaure pouvait-il voler ?</a></li>
                    <li>12/05/2020</li>
                    <li><a href="#">Les films avec un ou des tyrannosaures</a></li>
                    <li>05/02/2020</li>
                    <li><a href="#">Sa mangé quoi un tyronasaure ??</a></li>
                    <li>28/01/2020</li>
                </ul>
            </div>
            <div class="col-md-4 border border-danger m-auto">
                <img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?= base64_encode($data['image_principale']) ?>" />
            </div>
            <div class="col-md-5 m-auto">
                <p class="h5 text-center">Description</p>
                <p><?= $data['description'] ?></p>
                <p class="text-right">Source : WIKIPEDIA</p>
            </div>
            <div class="col-md-1 text-center border">
                <p class="h5 text-center">Ils ont vécus dans la même période :</p>
                <div><img src="assets/img/rexHead.png" style="width:100px; height:100px;" class="m-3 border border-danger" /></div>
                <div><img src="assets/img/parasaurolophusHead.jpg" style="width:100px; height:100px;" class="m-3 border border-success" /></div>
                <div><img src="assets/img/rexHead.png" style="width:100px; height:100px;" class="m-3 border border-danger" /></div>
            </div>
        </div>
</section>
<?php include 'views/parts/footer.php' ?>