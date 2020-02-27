<?php

    // On appelle les fichiers qui contiennent le header et les function définies dans la class Book
    require_once ('../inc/header.php');
    require_once ('../database/book.php');

    // On instancie la class Book
    $book = new Book();

    // On appelle la méthode indexBook pour sélectionner tous les livres
    $books = $book -> indexBook();
?>

<h1>Les Livres</h1>

<section>
    <div class="container">
        <?php
            // On initialise une boucle (pour chaque ligne de ma table book)
            foreach ($books as $book){
        ?>           
        <div class="card-book">

            <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
            <div class="imgBook">
                <?php echo '<a href="showBook.html.php?id='.$book['id'].'"><img src="'.$book["image"].'"></a>' ?>
            </div>
            <div class="card-body">                
                <h5 class="card-title"><?php echo $book['title'] ?></h5>
                <p>Auteur : </p>
                <p>Prix : </p>
                <div class="btn-commande">
                    <?php echo '<a href="showBook.html.php?id='.$book['id'].'" class="btn btn-info">Voir plus</a>' ?>
                </div>

            </div>
        </div>                           
        <?php
            }
        ?>
    </div>
</section>
 
<?php
    require_once ('../inc/footer.php');
?>