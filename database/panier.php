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
            header('Location: ../templates/panier.html.php');
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
            $request = $database->prepare('SELECT detailPanier.id as id, detailPanier.quantity as bookQuantity, detailPanier.panierId as panierId, book.title as bookTitle, book.image as bookImage, book.price as bookPrice FROM detailPanier LEFT JOIN book ON detailPanier.bookId = book.id WHERE panierId = ?');
            $request->execute([$panierId['id']]);
            return $showPanier = $request->fetchAll();       
        }

        public function createOrder($panierId){
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT userId FROM panier WHERE id = ?');
            $request->execute([$panierId]);
            $userId = $request->fetch();
            $request = $database->prepare('INSERT INTO orderTable SET id = ?, date = NOW(), userId = ?');
            $request->execute([$panierId, $userId['userId']]);

            $request = $database->prepare('INSERT INTO detailOrder (id, quantity, orderTableID, bookID) SELECT id, quantity, panierID, bookID FROM detailPanier WHERE panierId = ?');
            $request->execute([$panierId]);
            
            $this->dropPanier($panierId);
            session_start();
            $_SESSION['flash']['sucess'] = "Le paiement a bien été effectué. Vous pouvez consulter les détails de votre commande dans votre compte";  
            header('Location: ../templates/account.php');

        }

        public function dropPanier($panierId){
            $database = $this->getDatabase();            
            $request = $database->prepare('DELETE FROM detailPanier WHERE panierId = ?');
            $request->execute([$panierId]);
            $request = $database->prepare('DELETE FROM panier WHERE id =?');
            $request->execute([$panierId]);
        }

        public function deleteItemPanier($detailPanierId){
            $database = $this->getDatabase(); 
            var_dump($detailPanierId);          
            $request = $database->prepare('DELETE FROM detailPanier WHERE id = ?');
            $request->execute([$detailPanierId]);
            session_start();
            $_SESSION['flash']['sucess'] = "Votre livre a bien été supprimé du panier";  
            header('Location: ../templates/panier.html.php');
        }

        public function showOrders($userId){
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT id FROM orderTable WHERE userId = ?');
            $request->execute([$userId]);
            $orders = $request->fetchAll();
            $userOrders = [];
            foreach($orders as $order){
                $request = $database->prepare('SELECT detailOrder.quantity as bookQuantity, detailOrder.orderTableId as orderTableId, book.title as bookTitle, book.image as bookImage, book.price as bookPrice FROM detailOrder LEFT JOIN book ON detailOrder.bookId = book.id WHERE orderTableId = ?');
                $request->execute([$order['id']]);
                array_push($userOrders, $request->fetchAll());
            }
            return($userOrders);            
        }

        public function updatePanier($quantity, $panierItemId){
            $database = $this->getDatabase();
            $request = $database->prepare('UPDATE detailPanier SET quantity = ? WHERE id = ?');
            $request->execute([$quantity, $panierItemId]);
            $_SESSION['flash']['success'] = "Vous avez bien modifié la quantité du livre";                        
            header('Location: ../templates/panier.html.php');
        }

        public function calculatePrice($price, $quantity){
            return $price * $quantity;
        }
    }   

?>