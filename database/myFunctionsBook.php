<?php 

    require_once ('book.php');
    $newBook = new Book();

    // Ajout d'un livre
    if(isset($_POST['titleBook']) && isset($_POST['imageBook']) && isset($_POST['nameAuthorBook']) && isset($_POST['imageAuthorBook'])){   
        $titleBook = $_POST['titleBook'];
        $imageBook = $_POST['imageBook'];
        $nameAuthorBook = $_POST['nameAuthorBook'];
        $imageAuthorBook = $_POST['imageAuthorBook'];
        $newBook->insertBook($titleBook, $imageBook, $nameAuthorBook, $imageAuthorBook); 
    }

    // Modification d'un livre
    if (isset($_POST['updateTitleBook']) && isset($_POST['updateImageBook'])){
        if (empty($_POST['updateTitleBook']) && empty($_POST['updateImageBook'])){
            echo "Veuillez renseigner les champs Titre et Image";            
        }else{
            $updateTitleBook = $_POST['updateTitleBook'];
            $updateImageBook = $_POST['updateImageBook'];
            $bookId = (int)$_POST['idBook'];
            $newBook->updateBook($updateTitleBook, $updateImageBook, $bookId);
        }
    }

    // Suppresion d'un livre
    if(isset($_POST['deleteBook'])){
        $deleteBook = (int)$_POST['deleteBook'];
        $newBook -> deleteBook($deleteBook);  
    }

    // Modification d'un auteur associé
    if(isset($_POST['nameAuthorBook']) && isset($_POST['imageAuthorBook']) && isset($_POST['authorBookId'])){
        if (empty($_POST['nameAuthorBook']) && empty($_POST['imageAuthorBook'])){
            echo "Veuillez renseigner les champs Nom de l'auteur associé et Image de l'auteur associé";            
        }else{
            $nameAuthorBook = $_POST['nameAuthorBook'];
            $imageAuthorBook = $_POST['imageAuthorBook'];
            $authorBookId = $_POST['authorBookId'];
            $newBook -> authorBook($nameAuthorBook, $imageAuthorBook, $authorBookId);
        }
    }   
?>

<p>
    <a href="../templates/crud.html.php" title="Retour à l'accueil">Retour à l'accueil</a>
</p>









