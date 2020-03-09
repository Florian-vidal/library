<?php
    require_once ('../inc/header.php');
    require_once ('../database/panier.php');
    $panierUser = new Panier();
    $panierExist = $panierUser->panierExist($_SESSION['auth']['id']);
    $panierItems = $panierUser->showPanier($_SESSION['auth']['id']);
?>

<h1>Votre panier</h1>

<section>
    <div class="container">
    <?php 
    if($panierExist == true){
        $totalPrice = 0;
        foreach ($panierItems as $panierItem) {            
    ?>           
            <div class="card-book">

                <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
                <div class="imgBook">
                    <img src=" <?php echo $panierItem['bookImage'] ?>" alt="">
                </div>
                <div class="card-body">                
                    <h5 class="card-title"><?php echo $panierItem['bookTitle']; ?></h5>
                    <p>Auteur : </p>


                    <p>Prix : <?php echo $bookPrice = $panierUser->calculatePrice($panierItem['bookPrice'], $panierItem['bookQuantity']); ?> </p>
                    <?php $totalPrice += $bookPrice; ?>

                    <form action="../database/myFunctionsPanier.php" method="POST">
                        <label for="quantity">Quantité :</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="100" placeholder="<?php echo $panierItem['bookQuantity'] ?>">
                        <input type="hidden" name="panierItemId" value="<?php echo $panierItem['id']?>">
                        <div class="btn-commande">
                            <button type="submit">Ajouter</button>
                        </div>
                    </form>

                    <form action="../database/myFunctionsPanier.php" method="POST">
                        <input type="hidden" name="deleteItemPanier" value="<?php echo $panierItem['id'] ?>">
                        <div class="form-group">
                            <input type="submit" value="Supprimer du panier" class="btn btn-danger">
                        </div>
                    </form>                    

                </div>
            </div>                           
    <?php
        }
    ?>
        <form action="formPayment.html.php" method="POST">
            <p>Prix de la commande : <?php echo $totalPrice ?></p>
            <div class="btn-commande">
                <input type="hidden" name = "totalPrice" value="<?php echo $totalPrice ?>">
                <button type="submit">Procéder au paiement</button>
            </div>
            <input type="hidden" name="panierId" value="<?php echo $panierItems[0]['panierId']?>">
        </form>
    <?php
    } else {
        echo 'Votre panier est vide';
    }    
    ?>
    </div>

    
</section>

<?php require_once ('../inc/footer.php'); ?>
