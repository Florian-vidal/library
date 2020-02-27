<?php

    // On appelle les fichiers qui contiennent le header et les function définies dans la class Author
    require_once ('../inc/header.php');
    require_once ('../database/author.php');

    // On instancie la class Author
    $author = new Author();

    // On appelle la méthode indexAuthor pour sélectionner tous les auteurs
    $authors = $author->indexAuthor();
?>

<h1>Les Auteurs</h1>

<section>
    <div class="container">
        <?php
            // On initialise une boucle (pour chaque ligne de ma table author)
            foreach ($authors as $author){
        ?>
        <div class="card-book" style="">

            <!-- On affiche l'image et le nom de chaque auteur -->
            <div class="imgBook">
                <?php echo '<img src="' .$author["image"]. '" class="imgBook">';?>
            </div>            
            <div class="card-body">
                <h5 class="card-title"><?php echo $author['name'] ?></h5>
                <a href="#" class="btn btn-info">Voir plus</a>
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