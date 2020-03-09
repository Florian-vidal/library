<?php
    require ('../inc/functions.php');
    require_once ('../inc/header.php');
    require_once ('../database/panier.php');
    $userOrders = new Panier();
    $showOrders = $userOrders->showOrders($_SESSION['auth']['id']);



    // On appelle la function qui nous permet d'éviter que quelqu'un ait accès à la page Mon compte via l'URL s'il n'est pas authentifié
    logged_only();
?>

<h1>Bienvenue <?= $_SESSION['auth']['username'] ?> !</h1>

<div class="formInsert">
    <h4>Changer de mot de passe</h4>
    <form action="" method="POST">
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="text" name="password" class="form-control" id="password" placeholder="Mot de passe" required/>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmez votre mot de passe :</label>
            <input type="text" name="password_confirm" class="form-control" id="password_confirm" placeholder="Confirmer le mot de passe" required/>
        </div>
        <input type="submit" class="btn btn-info my-lg-5 offset-lg-4" value="Changer de mot de passe"></button>
    </form>
</div>

<hr>

<h1>Vos commandes</h1>
    <section>
        <div class="container-fluid" style="background: #f4f4f4; padding: 2em">
        <?php
            if ($showOrders == NULL) {
                echo '
                <table class="table table-hover">
                    <tr class="table-info">
                        <td><h6 style="text-align: center">Vous n\'avez pas de commandes.</h6></td>
                    </tr>
                </table>';
            } else { 
        ?>
            <?php 
                $n = 0;
                foreach ($showOrders as $order) {
            ?>           
                    <h4>Commande n°<?php echo $n += 1; ?></h4>
                    <div class="wrapper-commande">
                        <?php
                            foreach ($order as $detailOrder) {                                                       
                        ?>
                                <div class="card-book">

                                    <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
                                    <div class="imgBook">
                                        <img src=" <?php echo $detailOrder['bookImage'] ?>" alt="">
                                    </div>
                                    <div class="card-body">                
                                        <h5 class="card-title"><?php echo $detailOrder['bookTitle']; ?></h5>
                                        <p>Auteur : </p>
                                        <p>Prix : <?php echo $detailOrder['bookPrice'] ?>€</p>
                                    </div>
                                </div> 
                        <?php
                            }                                                  
                        ?>
                    </div>
                    <hr>
            <?php
                }
            ?> 
        </div>
    </section>
<?php
    }
?>

<a href="index.php" class="btn btn-outline-info my-lg-5 offset-lg-1">Retour à l'accueil</a>

<?php require_once ('../inc/footer.php'); ?>
