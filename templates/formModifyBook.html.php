<?php
    require_once ('../inc/header.php');
    require_once ('../database/book.php');  
    


?>

<h1 class="formTitleH1">Formulaire de modification d'un livre</h1>

<!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->
<div class="formInsert">
    <form action="../database/myFunctionsBook.php" method="POST">
        <div class="form-group">
            <label for="updateTitleBook">Modifier le titre :</label>
            <input type="text" name="updateTitleBook" id="updateTitleBook" class="form-control" placeholder="Entrer le titre d'un livre">
            <input type="hidden" name="idBook" value="<?php echo $_GET['id'] ?>">
        </div>
        <div class="form-group">
            <label for="updateImageBook">Modifier l'image :</label>
            <input type="text" name="updateImageBook" id="updateImageBook" class="form-control" placeholder="Entrer l'URL d'une image">
            <input type="hidden" name="idBook" value="<?php echo $_GET['id'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>

    </form>
    <form action="../database/myFunctionsBook.php" method="POST">
        <div class="form-group">
            <label for="nameAuthorBook">Nom de l'auteur associé :</label>
            <input type="text" name="nameAuthorBook" id="nameAuthorBook" class="form-control" placeholder="Entrer le nom d'un auteur">
        </div>
        <div class="form-group">
            <label for="imageAuthorBook">Image de l'auteur associé :</label>
            <input type="text" name="imageAuthorBook" id="imageAuthorBook" class="form-control" placeholder="Entrer l'URL d'une image">
            <input type="hidden" name="authorBookId" value="<?php echo $_GET['id'] ?>">

        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>

    </form>
</div>

<a href="crud.html.php" class="btn btn-info">Retour à l'espace Admin</a>


<?php
    require_once ('../inc/footer.php');
?>