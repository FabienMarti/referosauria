<?php
session_start();
$_SESSION['isConnected'] = true;
header('Location: ../index.php');
exit;