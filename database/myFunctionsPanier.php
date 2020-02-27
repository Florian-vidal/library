<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    require_once ('panier.php');
    $newPanier = new Panier();
    
    if(isset($_POST['insertPanier'])){
        if($_SESSION['auth']){
            $insertPanier = $_POST['insertPanier'];
            $newPanier -> insertPanier($insertPanier, $_SESSION['auth']['id']);
        } else {
            $_SESSION['flash']['danger'] = "Veuillez vous connecter pour ajouter un livre au panier";                        
            header('Location: ../templates/login.php');
        }
        
    }
?>