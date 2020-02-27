<?php 

    // Si le statut de la session n'exite pas, alors session_start se lance
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Le cercle des Poètes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../assets/css/app.css">

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Le cercle des Poètes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book.html.php">Les livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="author.html.php">Les auteurs</a>
                </li>

                <?php 
                    if(isset($_SESSION['auth'])){
                ?>      
                        <li class="nav-item">
                            <a class="nav-link" href="account.php">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="panier.html.php">Mon panier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Se déconnecter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="crud.html.php">Espace Admin</a>
                        </li>   

                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown link
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>  
                           
                <?php
                    }else{
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">S'inscrire</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Se connecter</a>
                        </li>
                <?php
                    }            
                ?>
            </ul>
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


   