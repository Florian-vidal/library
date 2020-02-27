<?php
    require_once ('../inc/header.php');
    require_once ("../database/author.php");
    $currentAuthor = new Author;
    $infoAuthor = $currentAuthor->showAuthor($_GET['id']);

?>

<section>            
    <div class="card" style="">
    <?php echo '<a href="showAuthor.html.php?id='.$infoAuthor['id'].'"><img src="'.$infoAuthor["image"].'" class="imgBook" ></a>' ?>
        <div class="card-body">
            <h5 class="card-title"><?php echo $infoAuthor['name'] ?></h5>
        </div>
    </div>                     
</section>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>