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
                echo '<a href="show.html.php?id='.$infoBook['id'].'"><img src="'.$infoBook["image"].'"></a>' 
            ?>
            
            <div class="card-body">
                <h5 class="card-title"><?php echo $infoBook['title'] ?></h5>
            
            <p>Auteur : 
                <?php
                    foreach($infoAuthors as $author){
                        echo $author['name'];
                    }
                ?>
            </p>
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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>