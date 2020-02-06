<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les livres</title>
</head>
<body>

<ul>
    <li><a href="../index.php">Accueil</a></li>
    <li><a href="book.html.php">Les livres</a></li>
    <li><a href="author.html.php">Les auteurs</a></li>
</ul>

<?php
    require_once ('../database/book.php');

    $book = new Book();
    $results = $book->indexBook();
?>

<h1>Voici les livres</h1>

<?php
    foreach ($results as $item){
        echo $item['title'];
    }
?>
   
</body>
</html>