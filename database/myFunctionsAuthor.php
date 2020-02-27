<?php 
     require_once ('author.php');
     $newAuthor = new Author();

     if(isset($_POST['nameAuthor']) || isset($_POST['imageAuthor']) || isset($_POST['titleBook']) || isset($_POST['imageBook'])){     
          $nameAuthor = $_POST['nameAuthor'];
          $imageAuthor = $_POST['imageAuthor'];
          $titleBook = $_POST['titleBook'];
          $imageBook = $_POST['imageBook'];
          $newAuthor -> insertAuthor($nameAuthor, $imageAuthor, $titleBook, $imageBook);
     }

     if(isset($_POST['updateNameAuthor']) || isset($_POST['updateImageAuthor'])){
          if (empty($_POST['updateNameAuthor']) && empty($_POST['updateImageAuthor'])){
               echo "Veuillez renseigner les champs Nom de l'auteur et Image de l'auteur'";            
          }else{        
               $updateNameAuthor = $_POST['updateNameAuthor'];
               $updateImageAuthor = $_POST['updateImageAuthor'];
               $authorId = $_POST['authorId'];
               $newAuthor -> updateAuthor($updateNameAuthor, $updateImageAuthor, $authorId);
          }
     }

     if(isset($_POST['deleteAuthor'])){
          $authorId = $_POST['deleteAuthor'];
          $newAuthor -> deleteAuthor($authorId);
     }

     if(isset($_POST['titleBookAuthor']) && isset($_POST['imageBookAuthor'])){
          if (empty($_POST['titleBookAuthor']) && empty($_POST['imageBookAuthor'])){
               echo "Veuillez renseigner les champs Titre du livre associé et Image du livre associé";            
          }else{
               $titleBookAuthor = $_POST['titleBookAuthor'];
               $imageBookAuthor = $_POST['imageBookAuthor'];
               $bookAuthorId = $_POST['bookAuthorId']; 
               $newAuthor -> bookAuthor($titleBookAuthor, $imageBookAuthor, $bookAuthorId);
          }
     }     
?>

<p>
    <a href="../templates/crud.html.php" title="Retour à l'accueil">Retour à l'accueil</a>
</p>









