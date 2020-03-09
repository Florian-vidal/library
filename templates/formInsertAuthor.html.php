<?php
    require_once ('../inc/header.php');
?>

<h1 class="formTitleH1">Formulaire d'ajout d'un auteur</h1>

<div class="formInsert">

    <!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->
    <form action="../database/myFunctionsAuthor.php" method="POST">
        <div class="form-group">
            <label for="insertNameAuthor">Nom de l'auteur :</label>
            <input type="text" name="nameAuthor" id="insertNameAuthor" class="form-control" placeholder="Entrer le nom d'un auteur" required/>
        </div>
        <div class="form-group">
            <label for="insertImageauthor">Image de l'auteur :</label>
            <input type="text" name="imageAuthor" id="insertImageauthor" class="form-control" placeholder="Entrer l'URL d'une image" required/>
        </div>
        <div class="form-group">
            <label for="insertTitleBookAuthor">Titre d'un livre associé :</label>
            <input type="text" name="titleBook" id="insertTitleBookAuthor" class="form-control" placeholder="Entrer le titre d'un livre" required/>
        </div>
        <div class="form-group">
            <label for="insertImageBookAuthor">Image du livre associé :</label>
            <input type="text" name="imageBook" id="insertImageBookAuthor" class="form-control" placeholder="Entrer l'URL d'une image" required/>
        </div>
            <button type="submit" class="btn btn-info offset-lg-5">Soumettre</button>
        </div>
    </form>
</div>

<?php require_once ('../inc/footer.php'); ?>
