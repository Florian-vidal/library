<?php
    require_once ('../inc/header.php');
    require_once ('../database/panier.php');
    require ('../inc/functions.php');

    logged_only();
?>

<h1>Votre paiement</h1>
<p>Total de <?php echo $_POST['totalPrice'] ?></p>
<div class="formInsert">

    <form action="../database/payment.php?panierId=<?php echo $_POST['panierId'] ?>&totalPrice=<?php echo $_POST['totalPrice'] ?>" id="payment_form" method="POST">
        <div class="form-group">
            <label for="username">Votre nom</label>
            <input type="text" name="username" class="form-control" id="username" value = "Batman" required/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value = "ezekielsxm@gmail.com"required/>
        </div>
        <div class="form-group">
            <label for="cb">Votre numéro de carte bancaire</label>
            <input type="text" data-stripe="number" value = "4242424242424242"required/>
        </div>
        <div class="form-group">
            <label for="month">MM</label>
            <input type="text" data-stripe="exp_month" value = "10" required/>
        </div>
        <div class="form-group">
            <label for="year">YY</label>
            <input type="text" data-stripe="exp_year" value = "21" required/>
        </div>
        <div class="form-group">
            <label for="code">CVC</label>
            <input type="text" data-stripe="cvc" value = "123" required/>
        </div>
        <div class="payment-errors" style="display: none">
            <p class="message"></p>
        </div>       
        <button type="submit" class="btn btn-primary" value="Acheter">Payer</button>
    </form>
</div>

<script src="https://js.stripe.com/v2/"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script>
    Stripe.setPublishableKey('pk_test_67vYRXEU8t2iyoaId6siV5OL00AKzn8arY')
    var $form = $('#payment_form') // On récupère le formulaire
    $form.submit(function (e) {
    e.preventDefault();
    $form.find('button').prop('disabled', true); // On désactive le bouton submit
    Stripe.card.createToken($form, function (status, response) {
        if (response.error) { // Ah une erreur !
            // On affiche les erreurs
            $form.find('.payment-errors').css('display', 'block');
            $form.find('.payment-errors').text(response.error.message);
            $form.find('button').prop('disabled', false); // On réactive le bouton
        } else { // Le token a bien été créé
            var token = response.id; // On récupère le token
            // On crée un champs caché qui contiendra notre token
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            console.log();
            $form.get(0).submit(); // On soumet le formulaire
            }
        });
    });
</script>

<?php require_once ('../inc/footer.php'); ?>

