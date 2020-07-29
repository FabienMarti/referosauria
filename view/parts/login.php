<?php
session_start();
$_SESSION['status'] = 'On';
header('Location: ../../index.php');
exit;