<?php
session_start();
$_SESSION['isConnected'] = false;
$_SESSION['role'] = null;
header('Location: ../index.php');
exit;