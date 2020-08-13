<?php 
include 'models/creatureModel.php';
include 'controllers/homeController.php';
?>  <div class="container-fluid">
        <div class="row justify-content-around">
            <!--Les derniers posts-->
            <div id="recentPostList" class="col-md-2 border">
                <p class="h4">Les derniers posts</p>
                <ul>
                    <li><a href="#">Le tyrannosaure pouvait-il voler ?</a></li>
                    <li>12/05/2020</li>
                    <li><a href="#">Le para pouvait-il voler ?</a></li>
                    <li>12/05/2020</li>
                    <li><a href="#">Les films avec un ou des tyrannosaures</a></li>
                    <li>05/02/2020</li>
                    <li><a href="#">Les films avec un ou des parasaures</a></li>
                    <li>05/02/2020</li>
                    <li><a href="#">Sa mangé quoi un tironasaure ??</a></li>
                    <li>28/01/2020</li>
                    <li><a href="#">Sa mangé quoi un parasorolophus ??</a></li>
                    <li>28/01/2020</li>
                </ul>
            </div>
            <!--Presentation Dino-->
            <div class="col-md-6 border border-dark">
                <div class="row">
                    <div class="col-md-4 my-auto"><img class="img-fluid" src="assets/img/gertie.jpg" alt="gertie le dinosaure" title="Gertie le Dinosaure" /></div>
                    <p class="col-md-8 text-justify my-auto">
                        Les dinosaures (du grec deinos, « terrible, magnifique », et sauros, « lézard ») sont des diapsides archosaures qui ont dominé les
                        écosystèmes
                        terrestres du
                        Trias supérieur (230 Ma) au Crétacé supérieur (66 Ma). Dès le Jurassique supérieur, ils donnent naissance aux oiseaux qui émergent de dinosaures carnivores proches des
                        Dromaeosauridae.
                        Parmi tous les groupes de dinosaures, seuls les oiseaux survivront à la crise Crétacé / Tertiaire qui eut lieu il y a 66 Ma. Les dinosaures se divisent en deux grands
                        ordres selon la morphologie de leur bassin : les Ornithischia et les Saurischia. Les ornithischiens ne comprennent que des dinosaures herbivores que les paléontologues
                        scindent en trois groupes majeurs, les Ornithopoda qui regroupent entre autres des dinosaures à « bec de canard » (ou Hadrosauridae), les Marginocephalia qui incluent des
                        dinosaures à collerette et à dôme osseux sur le haut de la tête (respectivement les Ceratopsia et les Pachycephalosauria), et enfin les Thyreophora qui englobent des
                        dinosaures surmontés d'armures, de piques et de plaques osseuses sur le dos et la queue (les Ankylosauria et les Stegosauria). Les saurischiens sont divisés en deux clades
                        bien distincts, les Theropoda, qui comprennent la totalité des dinosaures carnivores, et les Sauropodomorpha, munis d'un long cou, d'une petite tête et d'une très longue
                        queue.
                    </p>
                </div>
            </div>
            <div class="col-md-2 text-center border">
                <p class="h4">Les derniers Quizz</p>
                <div class="border border-info my-1 py-3">
                    <p>Quel dinosaure êtes vous ?</p>
                    <button class="btn btn-primary">Jouer</button>
                </div>
                <div class="border border-info my-1 py-3">
                    <p>Combien de temps survivrez vous chez les dinosaures ?</p>
                    <button class="btn btn-primary">Jouer</button>
                </div>
            </div>
        </div>
    </div>
    <section class="container mt-5">
        <h2 class="text-center">Dernières créatures</h2>
       
            <?php 
                foreach ($showLatestCreatureInfos as $crea) { ?>
                 <div class="mt-1 row border <?= $crea->id_r3f3r0_diet == 1 ? 'border-danger' : ($crea->id_r3f3r0_diet == 3 ? 'border-primary' : 'border-success') ?>">
                        <div class="col-md-4 text-center my-auto">
                            <img class="img-fluid" style="width: 50%" src="<?= $crea->miniImage ?>" alt="tête de <?= $crea->name ?>" title="<?= $crea->name ?>" />
                        </div>
                        <div class="col-md-8 text-justify">
                            <p class="h4 text-center"><a href="index.php?content=creature&id=<?= $crea->id ?>"><?= $crea->name ?></a></p>
                            <p><?= $crea->description ?></p>
                        </div>
                    </div>
            <?php } ?>
    </section>