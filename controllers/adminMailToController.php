<?php

$user = new user();

if(!empty($_GET['id'])){
    $user->id = htmlspecialchars($_GET['id']);
    $showUser = $user->getUserInfos();
}

