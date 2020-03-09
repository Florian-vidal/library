<?php
    // Si le statut de la session n'existe pas, alors session_start se lance
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    } 
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Le cercle des Poètes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/lux/bootstrap.min.css" rel="stylesheet" integrity="sha384-oOs/gFavzADqv3i5nCM+9CzXe3e5vXLXZ5LZ7PplpsWpTCufB7kqkTlC9FtZ5nJo" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="book.html.php">Les livres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="author.html.php">Les auteurs</a>
            </li> 
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Mon compte</a>
                <div class="dropdown-menu">
                <?php 
                    if (isset($_SESSION['auth'])) {
                ?>
                        <a class="dropdown-item" href="account.php">Mon compte</a>
                        <a class="dropdown-item" href="panier.html.php">Mon panier</a>
                        <a class="dropdown-item" href="logout.php">Se déconnecter</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="crud.html.php">Espace Admin</a>
                <?php
                    } else { 
                ?>
                            <a class="dropdown-item" href="register.php">S'inscrire</a>
                            <a class="dropdown-item" href="login.php">Se connecter</a>
                        </div> 
                <?php
                    }
                ?>
                </div>
            </li>
        </ul>
        <form action="searchResults.html.php" method="GET" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Rechercher" name="newSearch">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Ok</button>
        </form>
        </div>
    </nav>

    <main role="main">
    <?php if(isset($_SESSION['flash'])) :?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>


   