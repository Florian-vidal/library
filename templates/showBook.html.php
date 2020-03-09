<?php
    require_once ('../inc/header.php');
    require_once ("../database/book.php");
    $currentBook = new Book;
    $results = $currentBook->showBook($_GET['id']);
    $infoBook = $results['currentBook'];
    $infoAuthors = $results['currentAuthors'];
?>

<section>
    <div class="card-book-show" style="">
        <div class="imgBook">
            <?php 
            echo '<a href="showBook.html.php?id='.$infoBook['id'].'"><img src="'.$infoBook["image"].'"></a>' 
            ?>            
            <div class="card-body">
                <h5 class="card-title"><?php echo $infoBook['title'] ?></h5>                    
                <p>Auteur : 
                    <?php foreach($infoAuthors as $author){
                        echo $author['name'];
                    }
                    ?>
                </p>
                <p>Prix : <?php echo $infoBook['price'] ?>€</p> 
                <form action="../database/myFunctionsPanier.php" method="POST">                    
                    <input type="hidden" name="insertPanier" value="<?php echo $infoBook['id'] ?>">
                    <div class="btn-commande">
                        <input type="submit" value="Ajouter au panier" class="btn btn-info">
                    </div>
                </form>
            </div>
        </div>
    </div>                     
</section>

<a href="book.html.php" class="btn btn-outline-info my-lg-5 offset-lg-1">Retour aux livres</a>

<?php require_once ('../inc/footer.php'); ?>
