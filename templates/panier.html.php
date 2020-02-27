<?php
    require_once ('../inc/header.php');
    require_once ('../database/panier.php');
    $panierUser = new Panier();
    $panierExist = $panierUser->panierExist($_SESSION['auth']['id']);
    $showPanier = $panierUser->showPanier($_SESSION['auth']['id']);
?>

<h1>Votre panier</h1>

<section>
    <div class="container">
    <?php 
        if($panierExist == true){
            foreach($showPanier as $showCommande){
                
    ?>           
        <div class="card-book">

            <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
            <div class="imgBook">
                <img src=" <?php echo $showCommande['bookImage'] ?>" alt="">
            </div>
            <div class="card-body">                
                <h5 class="card-title"><?php echo $showCommande['bookTitle']; ?></h5>
                <p>Auteur : </p>
                <p>Prix : </p>
                <div class="btn-commande">
                    <button type="reset" value="<?php echo $showCommande['bookQuantity'] ?>">Ajouter</button>
                </div>

            </div>
        </div>                           
        <?php
            }
        } else {
            echo 'Votre panier est vide';
        }
        ?>
    </div>
</section>