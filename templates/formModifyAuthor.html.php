<?php
    require_once ('../inc/header.php');
    require_once ('../database/author.php');   
?>

<h1 class="formTitleH1">Formulaire de modification d'un auteur</h1>

<!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->
<div class="formInsert">
    <form action="../database/myFunctionsAuthor.php" method="POST">
        <div class="form-group">
            <label for="updateNameAuthor">Modifier le nom :</label>
            <input type="text" name="updateNameAuthor" id="updateNameAuthor" class="form-control" placeholder="Entrer le nom de l'auteur" required/>
            <input type="hidden" name="idAuthor" value="<?php echo $_GET['id'] ?>">
        </div>
        <div class="form-group">
            <label for="updateImageAuthor">Modifier l'image :</label>
            <input type="text" name="updateImageAuthor" id="updateImageAuthor" class="form-control" placeholder="Entrer l'URL d'une image" required/>
            <input type="hidden" name="idAuthor" value="<?php echo $_GET['id'] ?>">
        </div>

        <button type="submit" class="btn btn-info offset-lg-5">Soumettre</button>

    </form>
    <form action="../database/myFunctionsAuthor.php" method="POST">
        <div class="form-group">
            <label for="titleBookAuthor">Titre du livre associé :</label>
            <input type="text" name="titleBookAuthor" id="titleBookAuthor" class="form-control" placeholder="Entrer le titre d'un livre" required/>
        </div>
        <div class="form-group">
            <label for="imageBookAuthor">Image de l'auteur associé :</label>
            <input type="text" name="imageBookAuthor" id="imageBookAuthor" class="form-control" placeholder="Entrer l'URL d'une image" required/>
            <input type="hidden" name="bookAuthorId" value="<?php echo $_GET['id'] ?>">
        </div>

        <button type="submit" class="btn btn-info offset-lg-5">Soumettre</button>

    </form>
</div>

<a href="crud.html.php" class="btn btn-outline-info offset-lg-1">Retour à l'espace Admin</a>

<?php require_once ('../inc/footer.php'); ?>
