<?php

    // On appelle les fichiers qui comportent les function définies dans les class Book et Author
    require_once ('../inc/header.php');
    require_once ('../database/book.php'); 
    require_once ('../database/author.php');

    // On instancie la class Book et Author
    $book = new Book();
    $books = $book->indexBook();
    $author = new Author();
    $authors = $author->indexAuthor();
?>

<h1>Espace Admin</h1>

<!-- Boutons d'ajout d'un livre et d'un auteur qui renvoient vers un formulaire -->
<section class="insert-book-author">
    <a href="formInsertBook.html.php" class="btn btn-info">Ajouter un livre</a>
    <a href="formInsertAuthor.html.php" class="btn btn-info">Ajouter un auteur</a>
</section>
    
<section>
    <h2>Modification d'un livre et d'un auteur associé</h2>
    <div class="container">
        <?php
            // On initialise une boucle (pour chaque ligne de ma table book)
            foreach ($books as $book){
        ?>           
                
                <div class="card-book" style="">

                    <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
                    <div class="imgBook">
                        <?php echo '<a href="showBook.html.php?id='.$book['id'].'"><img src="'.$book["image"].'"></a>' ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $book['title'] ?></h5>
                    </div>
                    <?php echo '<a href="formModifyBook.html.php?id='.$book['id'].'">TEST</a>' ?>

                    <a href="formModifyBook.html.php" class="btn btn-info" value="<?php echo $book['id'] ?>">Modifier un livre</a>
                  
                    <form action="../database/myFunctionsBook.php" method="POST">                    
                        <label for="updateTitleBook">Modifier le titre :</label>
                        <input type="text" name="updateTitleBook" id="updateTitleBook">
                        <input type="hidden" name="idBook" value="<?php echo $book['id'] ?>">

                        <label for="updateImageBook">Modifier l'image :</label>
                        <input type="text" name="updateImageBook" id="updateImageBook">
                        <input type="hidden" name="idBook" value="<?php echo $book['id'] ?>">

                        <input type="submit" value="Modifier" class="btn btn-info">
                    </form>                   
                    <form action="../database/myFunctionsBook.php" method="POST">                    
                        <label for="nameAuthorBook">Nom de l'auteur associé :</label>
                        <input type="text" name="nameAuthorBook" id="nameAuthorBook">

                        <label for="imageAuthorBook">Image de l'auteur associé :</label>
                        <input type="text" name="imageAuthorBook" id="imageAuthorBook">

                        <input type="hidden" name="authorBookId" value="<?php echo $book['id'] ?>">

                        <input type="submit" value="Soumettre" class="btn btn-info">
                    </form>

                    <!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->                    
                    <form action="../database/myFunctionsBook.php" method="POST">                    
                        <label for="deleteBook">Supprimer le livre :</label>                  
                        <input type="hidden" name="deleteBook" value="<?php echo $book['id'] ?>">
                        <div class="form-group">
                            <input type="submit" value="Supprimer" class="btn btn-info">
                        </div>
                    </form>
                </div>                     
        <?php
            }
        ?>
    </div>
</section>

<h2>Modification d'un auteur</h2>

<section>
    <div class="container">
        <?php

            // On initialise une boucle (pour chaque ligne de ma table author)
            foreach ($authors as $author){
        ?>           
                <div class="card-book" style="">

                    <!-- En cliquant sur l'image d'un auteur, j'envoie son id vers la page showAuthor pour son affichage individuel -->
                    <div class="imgBook">
                        <?php echo '<a href="showAuthor.html.php?id=' .$author['id']. '"><img src="' .$author['image']. '"></a>';?> 
                    </div>                   
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $author['name'] ?></h5>
                    </div>

                    <!-- Grâce à un formulaire et la méthode POST, je récupère les valeurs entrées dans les champs -->
                    <form action="../database/myFunctionsAuthor.php" method="POST">
                        <label for="updateNameAuthor">Modifier nom de l'auteur :</label>
                        <input type="text" name="updateNameAuthor" id="updateNameAuthor">

                        <label for="updateImageAuthor">Modifier image de l'auteur :</label>
                        <input type="text" name="updateImageAuthor" id="updateImageAuthor">
                        <input type="hidden" name="authorId" value="<?php echo $author['id'] ?>">
                        <input type="submit" value="Modifier" class="btn btn-info">
                    </form>               
                    <form action="../database/myFunctionsAuthor.php" method="POST">
                        <label for="titleBookAuthor">Titre du livre associé :</label>
                        <input type="text" name="titleBookAuthor" id="titleBookAuthor">

                        <label for="imageBookAuthor">Image du livre associé :</label>
                        <input type="text" name="imageBookAuthor" id="imageBookAuthor">

                        <input type="hidden" name="bookAuthorId" value="<?php echo $author['id'] ?>">

                        <input type="submit" value="Soumettre" class="btn btn-info">
                    </form> 
                    <form action="../database/myFunctionsAuthor.php" method="POST">
                        <label for="deleteAuthor">Supprimer l'auteur :</label>                  
                        <input type="hidden" name="deleteAuthor" value="<?php echo $author['id'] ?>">
                        <div class="form-group">
                            <input type="submit" value="Supprimer" class="btn btn-info">
                        </div>
                    </form>       
                </div>             
        <?php
            }
        ?>
    </div>
</section>

<?php
    require_once ('../inc/footer.php');
?>