<?php
session_start();
$_SESSION['status'] = 'Off';
header('Location: ../../index.php');
exit;