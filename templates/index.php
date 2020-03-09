<?php
require_once ('../inc/header.php');
require_once ('../database/book.php');
require_once ('../database/author.php');

// On instancie la class Book
$book = new Book();
$author = new Author();

// On appelle la méthode indexBook pour sélectionner tous les livres
$books = $book -> indexBook();
$authors = $author->indexAuthor();
?>

<div class="jumbotron" >
    <h1 class="display-4">Le Cercle Des Poètes</h1>
    <p class="lead">Bonjour et bienvenue dans le Cercle ! <br>Tout d'abord, merci à toi de t'être aventuré aux confins de l'internet sur un site qui sera probablement consulté par peu de personnes. Nous sommes une modeste librairie qui souhaite faire découvrir des oeuvres parfois controversées, parfois sous-estimées. Alors n'hésites pas à découvrir les rubriques des bouquins et des auteurs</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Qui sommes-nous ?</a>
    </p>
</div>
<div class="triangle-blanc1">
</div>

<h1 class="h1-les-nouveaux-bouquins">
    <div class="img-les-nouveaux-bouquins">
    <img src="../assets/image/les-nouveaux-bouquins.jpg">
    </div>Les nouveaux bouquins
</h1>

<section>
    <div class="les-nouveaux-bouquins">
        <div class="background-black">
        </div>
        <div class="container py-lg-5">
            <?php 
        
            // On affiche les 6 derniers livres de mon instance books
            $newBooks = array_slice($books, -5, 5, 1); 

            // On initialise une boucle (pour chaque ligne de ma table book)
            foreach ($newBooks as $book) {
            ?>           
                <div class="card-book-les-nouveaux-bouquins">

                    <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
                    <div class="imgBook">
                        <?php echo '<a href="showBook.html.php?id='.$book['id'].'"><img src="'.$book['image'].'"></a>' ?>
                    </div>
                    <div class="card-body">                
                        <h5 class="card-title"><?php echo $book['title'] ?></h5>
                        <p>Auteur : </p>
                        <p>Prix : <?php echo $book['price'] ?>€</p>
                        <div class="btn-commande">
                            <?php echo '<a href="showBook.html.php?id='.$book['id'].'" class="btn btn-info">Voir plus</a>' ?>
                        </div>
                    </div>
                </div>                           
            <?php
            }
            ?>
        </div>
    </div>
</section>

<h1 class="h1-les-nouveaux-auteurs">
    <div class="img-les-nouveaux-auteurs">
        <img src="../assets/image/les-nouveaux-auteurs.jpg">
    </div>Les nouveaux auteurs
</h1>

<section>
    <div class="les-nouveaux-auteurs">
        <div class="background-black">
        </div>
        <div class="container py-lg-5">
            <?php 

            // On affiche les 6 derniers auteurs de mon instance authors
            $newAuthors = array_slice($authors, -5, 5, 1); 
        
            // On initialise une boucle (pour chaque ligne de ma table author)
            foreach ($newAuthors as $author){
            ?>
                <div class="card-book-les-nouveaux-auteurs">

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
    </div>
</section>

<div class="citation">
    <h1>—La citation du moment—</h1>  
    <blockquote> 
        <p>"Ph'nglui mglw'nqfh Cthulhu R'lyeh wgah'nagl fhtagn : Dans sa demeure de R'lyeh la morte Cthulhu rêve et attend."</p>
        <div class="quote">
            <div class="imgQuote">
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/10/H._P._Lovecraft%2C_June_1934.jpg" alt="">
            </div>
            <footer>—Howard Phillips Lovecraft, <cite>L'Appel de Cthulhu (1926)</cite></footer>
        </div>
    </blockquote>
</div>

<?php require_once ('../inc/footer.php'); ?>
