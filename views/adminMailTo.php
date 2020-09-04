<?php 
$pageTitle = 'Envoyer un mail';
include 'parts/header.php';
include '../controllers/adminMailToController.php';
?>
<div class="container divBackColor rounded my-5 p-5">
    <h1 class="text-center">Envoyer un email à <?= $showUser->username ?></h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="mail">Email : </label>
            <input type="email" name="mail" id="mail" class="form-control" value="<?= $showUser->mail ?>" disabled />
        </div>
        <div class="form-group">
            <label for="subject">Objet : </label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="" value="Sujet : " />
        </div>
        <div class="form-group">
            <label for="message">Message : </label>
            <textarea name="message" id="message" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="sendMail" id="sendMail" class="form-control btn btn-primary" />
        </div>
    </form>
</div>
<?php include 'parts/footer.php' ?>