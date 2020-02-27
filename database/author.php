<?php

    require_once ('database.php');

    // Déclaration d'une class Author qui hérite de la class Database
    class Author extends Database
    {
        // Affichage des auteurs
        public function indexAuthor()
        {
            $database = $this->getDatabase();
            $request = $database->query('SELECT * FROM author');
            $results = $request->fetchAll();

            return $results;
        }

        // Affichage d'un auteur individuel
        public function showAuthor($authorId)
        {
            $database = $this->getDatabase();
            $request = $database->query('SELECT * FROM author WHERE id=' .$authorId);
            $result = $request->fetch();
            return $result;
        }

        // Insertion d'un auteur (nom, image, titre d'un livre associé, image d'un livre associé)
        public function insertAuthor($nameAuthor, $imageAuthor, $titleBook, $imageBook){
            $database = $this->getDatabase();
            $request = 'INSERT INTO author (name, image) VALUES ("'.$nameAuthor.'", "'.$imageAuthor.'")';
            $database -> exec($request);
            $request = $database->query('SELECT id FROM author WHERE name="'.$nameAuthor.'" AND image= "'.$imageAuthor.'"');
            $authorId = $request->fetch();
            $request = 'INSERT INTO book (title, image) VALUES ("'.$titleBook.'", "'.$imageBook.'")';
            $database -> exec($request);
            $request = $database->query('SELECT id FROM book WHERE title="'.$titleBook.'" AND image= "'.$imageBook.'"');
            $bookId = $request->fetch();
            $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$authorId['id'].', '.$bookId['id'].')';
            $database -> exec($request);
            if($request == true){
                $message = 'L\'auteur ' .$nameAuthor. ' a bien été ajouté à la base de données.';
            }else{
                $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
            }
            echo $message;
        }

        // Modification d'un auteur
        public function updateAuthor($updateNameAuthor, $updateImageAuthor, $authorId)
        {
            $database = $this->getDatabase();
            $request = 'UPDATE author SET name="' .$updateNameAuthor. '", image="' .$updateImageAuthor. '" WHERE id=' .$authorId;
            $database ->exec($request);
            if($request == true){
                $message = 'L\'auteur '  .$updateNameAuthor. ' a bien été modifié dans la base de données.';
            }else{
                $message = "Erreur : un problème est survenu lors de la modification de l'auteur en base de données.";
            }
            echo $message;
        }

        public function deleteAuthor($authorId)
        {
            $database = $this->getDatabase();
            $request = 'DELETE FROM bookAuthor WHERE authorId=' .$authorId;
            $database ->exec($request);
            $request = 'DELETE FROM author WHERE id=' .$authorId;
            $database ->exec($request);
            if($request == true){
                $message = 'L\'auteur a bien été supprimé dans la base de données.';
            }else{
                $message = "Erreur : un problème est survenu lors de la suppression de l'auteur en base de données.";
            }
            echo $message;
        }

        public function bookAuthor($titleBookAuthor, $imageBookAuthor, $bookAuthorId){
            $database = $this->getDatabase();

            $request = $database->query('SELECT * FROM book WHERE title="' .$titleBookAuthor.'"');
            $result = $request->fetch();
            if($result==false){
                $request = 'INSERT INTO book (title, image) VALUES ("'.$titleBookAuthor.'", "'.$imageBookAuthor. '")';
                $database ->exec($request);
                
                $request = $database->query('SELECT id FROM book WHERE title="'.$titleBookAuthor.'" AND image= "'.$imageBookAuthor.'"');
                $bookId = $request->fetch();
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$bookAuthorId.', '.$bookId['id'].')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un livre a bien été créé et associé à l\'auteur.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }else{
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$bookAuthorId.', '.$result['id'].')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un livre a bien été associé à l\'auteur.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }
        }   
    }

?>