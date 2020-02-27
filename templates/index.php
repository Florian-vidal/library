<?php

    // On appelle les fichiers qui contiennent le header et les function définies dans la class Book
    require_once ('../inc/header.php');
    require_once ('../database/book.php');

    // On instancie la class Book
    $book = new Book();

    // On appelle la méthode indexBook pour sélectionner tous les livres
    $books = $book -> indexBook();

    require_once ('../inc/footer.php');

?>