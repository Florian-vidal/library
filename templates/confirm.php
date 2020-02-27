<?php

    require_once ( '../database/user.php');

    // On récupère les champs id et token passés en GET dans l'URL 
    $newUser = new User;
    $user_id = $_GET['id'];
    $token = $_GET['token'];
    $newUser -> confirmToken($user_id, $token);

?>

