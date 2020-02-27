<?php

    require_once ('database.php');
    require_once ('book.php');

    // Déclaration d'une class Panier qui hérite de la class Database
    class Panier extends Database
    {
        public function createPanier($userId){
            $database = $this->getDatabase(); 
            $request = $database->prepare('INSERT INTO panier SET userId = ?, creation_panier = NOW()');
            $request->execute([$userId]);
        }

        public function insertPanier($insertPanier, $userId){
            $database = $this->getDatabase(); 
            $request = $database->prepare('SELECT id FROM panier WHERE userId = ?');
            $request->execute([$userId]);
            $panierId = $request->fetch();
            if($panierId==false){
                $this->createPanier($userId);
                $request = $database->prepare('SELECT id FROM panier WHERE userId = ?');
                $request->execute([$userId]);
                $panierId = $request->fetch();
            }
           
            $request = $database->prepare('SELECT id FROM detailPanier WHERE bookId = ? AND panierId = ?');
            $request->execute([$insertPanier, $panierId['id']]);
            $detailPanierId = $request->fetch();
            if($detailPanierId==false){
                $request = $database->prepare('INSERT INTO detailPanier SET panierId = ?, bookId = ?, quantity = 1');
                $request->execute([$panierId['id'], $insertPanier]);
            } else {
                $request = $database->prepare('UPDATE detailPanier SET quantity = quantity + 1 WHERE id = ?');
                $request->execute([$detailPanierId['id']]);
            }
            $_SESSION['flash']['sucess'] = "Votre livre a bien été ajouté au panier";  
            header('Location: ../templates/crud.html.php');
        }
    
        public function panierExist($userId){
            $database = $this->getDatabase(); 
            $request = $database->prepare('SELECT id FROM panier WHERE userId = ?');
            $request->execute([$userId]);
            $panierId = $request->fetch();
            if($panierId==false){
                return false;
            } else {
                return true;
            }
        }

        public function showPanier($userId){
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT id FROM panier WHERE userId = ?');
            $request->execute([$userId]);
            $panierId = $request->fetch();
            $request = $database->prepare('SELECT detailPanier.quantity as bookQuantity, book.title as bookTitle, book.image as bookImage FROM detailPanier LEFT JOIN book ON detailPanier.bookId = book.id WHERE panierId = ?');
            $request->execute([$panierId['id']]);
            return $showPanier = $request->fetchAll();
        
        }
    }   

?>