<?php
$user = new user();
$showUserInfo = $user->getAllUsersInfos();
$showSingleUser = $user->getUserInfosAsAdmin(2);


