<?php 
$pageTitle = 'Quiz';
include 'parts/header.php';
include '../controllers/breadcrumb.php';
generateBreadcrumb(array('../index.php' => 'Referosauria', 'final' => $pageTitle));
?>
<?php include 'parts/footer.php' ?>