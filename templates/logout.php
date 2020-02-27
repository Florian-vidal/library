<?php

    session_start();

    unset($_SESSION['auth']);

    $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

    setcookie('remember', NULL, -1);
    
    header('Location: login.php');

?>