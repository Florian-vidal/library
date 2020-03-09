<?php
require_once ('../inc/header.php');
require_once ("../database/author.php");
$currentAuthor = new Author;
$results = $currentAuthor->showAuthor($_GET['id']);
$infoAuthor = $results['currentAuthor'];
$infoBooks = $results['currentBooks'];

?>

<section>
    <div class="card-book-show" style="">
        <div class="imgBook">
            <?php 
                echo '<a href="showAuthor.html.php?id='.$infoAuthor['id'].'"><img src="'.$infoAuthor['image'].'"></a>' 
            ?>           
            <div class="card-body">
                <h5 class="card-title"><?php echo $infoAuthor['name'] ?></h5>           
                <p>Livres : 
                    <?php foreach($infoBooks as $book){
                        echo $book['title'];
                    }
                    ?>
                </p> 
            </div>
        </div>
    </div>                     
</section>

<a href="book.html.php" class="btn btn-outline-info my-lg-5 offset-lg-1">Retour aux livres</a>

<?php require_once ('../inc/footer.php'); ?>
