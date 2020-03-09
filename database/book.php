<?php

    require_once ('database.php');

    // Déclaration d'une classe Book qui hérite de la classe Database
    class Book extends Database
    {
        public function indexBook()
        {
            $database = $this->getDatabase();
            $request = $database->query('SELECT * FROM book');
            $results = $request->fetchAll();
            return $results;
        }

        public function insertBook($titleBook, $imageBook, $nameAuthorBook, $imageAuthorBook){
            $database = $this->getDatabase();
            $request = 'INSERT INTO book(title, image) VALUES ("'.$titleBook.'", "'.$imageBook. '")';
            $database ->exec($request);
            $request = $database->query('SELECT id FROM book WHERE title="'.$titleBook.'" AND image= "'.$imageBook.'"');
            $bookId = $request->fetch();
            $request = $database->query('SELECT * FROM author WHERE name="' .$nameAuthorBook.'"');
            $result = $request->fetch();   
            if($result==false){
                $request = 'INSERT INTO author (name, image) VALUES ("'.$nameAuthorBook.'", "'.$imageAuthorBook. '")';
                $database->exec($request);       
                $request = $database->query('SELECT id FROM author WHERE name="'.$nameAuthorBook.'" AND image= "'.$imageAuthorBook.'"');
                $authorId = $request->fetch();          
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$authorId['id'].', '.$bookId['id'].')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un auteur a bien été créé et associé au livre.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }else{           
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$result['id'].', '.$bookId['id'].')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un auteur a bien été associé au livre.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }
        }

        public function updateBook($updateTitleBook, $updateImageBook, $updatePriceBook, $bookId){

            $database = $this->getDatabase();
            $request = 'UPDATE book SET title = "'.$updateTitleBook.'", image = "' .$updateImageBook. '", price = "' .$updatePriceBook. '" WHERE id ='.$bookId.'';
            $database ->exec($request);
            if($request == true){
                $message = 'Le livre ' .$updateTitleBook. ' a bien été modifé dans la base de données.';
            }else{
                $message = "Erreur : un problème est survenu lors de l'enregistrement du livre en base de données.";
            }
            echo $message;
        }

        public function deleteBook($deleteBook){
            $database = $this->getDatabase();           
            $request = 'DELETE FROM bookauthor WHERE bookId = '.$deleteBook.'';
            $database ->exec($request);
            $request = 'DELETE FROM book WHERE id ='.$deleteBook.'';
            $database ->exec($request);
            if($request == true){
                $message = 'Le livre a bien été supprimé dans la base de données.';
            }else{
                $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
            }
            echo $message;
        }

        public function showBook($bookId)
        {
            $database = $this->getDatabase();
            $requestBook = $database->query('SELECT * FROM book WHERE id ='.$bookId.'');
            $requestAuthors = $database->query('SELECT author.name FROM author as author INNER JOIN bookAuthor as bookAuthor 
            ON author.id = bookAuthor.authorID WHERE bookAuthor.bookID =' .$bookId );
            $currentBook = $requestBook->fetch();
            $currentAuthors = $requestAuthors->fetchAll();

            return $arrayResults = [
                'currentBook' => $currentBook,
                'currentAuthors' => $currentAuthors
            ];
        }

        public function authorBook($nameAuthorBook, $imageAuthorBook, $authorBookId){
            $database = $this->getDatabase();
            $request = $database->query('SELECT * FROM author WHERE name="' .$nameAuthorBook.'"');
            $result = $request->fetch();
            if($result==false){
                $request = 'INSERT INTO author (name, image) VALUES ("'.$nameAuthorBook.'", "'.$imageAuthorBook. '")';
                $database ->exec($request);
                
                $request = $database->query('SELECT id FROM author WHERE name="'.$nameAuthorBook.'" AND image= "'.$imageAuthorBook.'"');
                $authorId = $request->fetch();
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$result['id'].', '.$authorBookId.')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un livre a bien été créé et associé à l\'auteur.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }else{
                $request = 'INSERT INTO bookAuthor (authorId, bookId) VALUES ('.$result['id'].', '.$authorBookId.')';
                $database ->exec($request);
                if($request == true){
                    $message = 'Un auteur a bien été associé au livre.';
                }else{
                    $message = "Erreur : un problème est survenu lors de l'enregistrement de l'auteur en base de données.";
                }
                echo $message;
            }
        }

        
    }

?>