<?php


    require_once ('../database/user.php');
    $newRole = new User();
    $newRole->verifyRole();
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
    <h1>Modification d'un livre</h1>
    <div class="container">
        <table class="table table-hover">
            <?php
            foreach ($books as $book){
            ?>           
                <tbody>
                    <tr class="table">
                        <th scope="row">
                            <div class="imgBookCrud">
                                <?php echo '<a href="showBook.html.php?id='.$book['id'].'"><img src="'.$book["image"].'"></a>' ?>
                            </div>
                            <h5 class="card-title"><?php echo $book['title'] ?></h5>
                        </th> 
                        <td><?php echo '<a href="formModifyBook.html.php?id='.$book['id'].'"><input type="submit" value="Modifier" class="btn btn-info"></a>' ?></td>
                        <td>
                            <form action="../database/myFunctionsBook.php" method="POST">
                                <input type="hidden" name="deleteBook" value="<?php echo $book['id'] ?>">
                                <div class="form-group">
                                    <input type="submit" value="Supprimer" class="btn btn-danger">
                                </div>
                            </form>
                        </td>
                    </tr>
                    
                </tbody>
            <?php
            }
            ?>
        </table> 
    </div>
</section>

<section>
    <h1>Modification d'un auteur</h1>
    <div class="container">
        <table class="table table-hover">
            <?php
            foreach ($authors as $author){
            ?>           
                <tbody>
                    <tr class="table">
                        <th scope="row">
                            <div class="imgBookCrud">
                                <?php echo '<a href="showAuthor.html.php?id='.$author['id'].'"><img src="'.$author["image"].'"></a>' ?>
                            </div>
                            <h5 class="card-title"><?php echo $author['name'] ?></h5>
                        </th> 
                        <td><?php echo '<a href="formModifyAuthor.html.php?id='.$author['id'].'"><input type="submit" value="Modifier" class="btn btn-info"></a>' ?></td>
                        <td>
                            <form action="../database/myFunctionsAuthor.php" method="POST">
                                <input type="hidden" name="deleteAuthor" value="<?php echo $author['id'] ?>">
                                <div class="form-group">
                                    <input type="submit" value="Supprimer" class="btn btn-danger">
                                </div>
                            </form>
                        </td>
                    </tr>
                    
                </tbody>
            <?php
            }
            ?>
        </table> 
    </div>
</section>

<?php require_once ('../inc/footer.php'); ?>
