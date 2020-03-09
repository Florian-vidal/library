<?php
    require_once ('../inc/header.php');
?>

<h1 class="formTitleH1">Formulaire d'ajout d'un livre</h1>

<!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->
<div class="formInsert">
    <form action="../database/myFunctionsBook.php" method="POST">
        <div class="form-group">
            <label for="insertTitleBook">Titre du livre :</label>
            <input type="text" name="titleBook" id="insertTitleBook" class="form-control" placeholder="Entrer le titre d'un livre" required/>
        </div>
        <div class="form-group">
            <label for="insertImageBook">Image du livre :</label>
            <input type="text" name="imageBook" id="insertImageBook" class="form-control" placeholder="Entrer l'URL d'une image" required/>
        </div>
        <div class="form-group">
            <label for="insertNameAuthorBook">Nom de l'auteur associé :</label>
            <input type="text" name="nameAuthorBook" id="insertNameAuthorBook" class="form-control" placeholder="Entrer le nom d'un auteur" required/>
        </div>
        <div class="form-group">
            <label for="insertImageAuthorBook">Image de l'auteur associé :</label>
            <input type="text" name="imageAuthorBook" id="insertImageAuthorBook" class="form-control" placeholder="Entrer l'URL d'une image" required/>
        </div>
            <button type="submit" class="btn btn-info offset-lg-5">Soumettre</button>
        </div>
    </form>
</div>

<?php require_once ('../inc/footer.php'); ?>
