<?php     
    require_once ('../inc/header.php');
    require_once ('../database/Search.php');
?>
<?php
    if (isset($_GET['newSearch'])) {
        if (!empty($_GET['newSearch'])) {
            $newSearch = new Search;
            $searchContent = $_GET['newSearch'];
            $searchResults = $newSearch -> searchContent($searchContent);
            if ($searchResults == NULL) {
?>              
                <div class="alert alert-danger" role="alert">
                    Votre recherche ne donne pas de résultats.
                </div>
<?php
            }
        } else {
?>
            <div class="alert alert-danger" role="alert">
                Tape un truc dans la bare de recherche mongolo
            </div>
<?php
        }
    }   
?>

<h1>Résultats de votre recherche</h1>

<h1>Les Livres</h1>
<section>
    <div class="container">
        <?php
            // On initialise une boucle (pour chaque ligne de ma table book)
            foreach ($searchResults as $searchResult) {
        ?>           
        <div class="card-book">

            <!-- En cliquant sur l'image d'un livre, j'envoie son id vers la page showBook pour son affichage individuel -->
            <div class="imgBook">
                <?php echo '<a href="showBook.html.php?id='.$searchResult['title'].'"><img src="'.$searchResult["image"].'"></a>' ?>
            </div>
            <div class="card-body">                
                <h5 class="card-title"><?php echo $searchResult['title'] ?></h5>
                <p>Auteur : </p>
                <p>Prix : <?php echo $searchResult['price'] ?>€</p>
                <div class="btn-commande">
                    <?php echo '<a href="showBook.html.php?id='.$searchResult['id'].'" class="btn btn-info">Voir plus</a>' ?>
                </div>

            </div>
        </div>                           
        <?php
            }
        ?>
    </div>
</section>

<?php require_once ('../inc/footer.php'); ?>

