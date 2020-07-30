<?php
session_start();
$_SESSION['isConnected'] = false;
header('Location: ../index.php');
exit;