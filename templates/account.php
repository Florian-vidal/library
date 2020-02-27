<?php

    require ('../inc/functions.php');
    require_once ('../inc/header.php');

    // On appelle la function qui nous permet d'éviter que quelqu'un ait accès à la page Mon compte via l'URL s'il n'est pas authentifié
    logged_only();

?>

<h1>Bienvenue <?= $_SESSION['auth']['username'] ?> !</h1>

<div class="formInsert">
    <h4>Changer de mot de passe</h4>
    <form action="" method="POST">
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" class="form-control" id="password" />
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmez votre mot de passe</label>
            <input type="text" name="password_confirm" class="form-control" id="password_confirm" />
        </div>
        <input type="submit" class="btn btn-primary" value="Changer de mot de passe"></button>
    </form>
</div>

<?php
    require_once ('../inc/footer.php');
?>
