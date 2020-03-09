<?php
    require_once ('../inc/header.php');
    require_once ('../database/user.php');
    require_once ('../database/database.php');
    $newDatabase = new Database;
    $database = $newDatabase->getDatabase();
?>

<?php 

    // On vérifie que si les champs ne sont pas vides et qu'ils correspondent aux identifiants entrés par le même utilisateur avant
    if(!empty($_POST) && !empty($_POST['email'])){
        $request = $database->prepare('SELECT * FROM user WHERE email = ? AND confirmed_at IS NOT NULL');
        $request->execute([$_POST['email']]);
        $user = $request->fetch();
        if($user){
            session_start();
            $reset_token = str_random(60);
            $database->prepare('UPDATE user SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user['id']]);
            $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par email';
            mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://127.0.0.1:8080/library/templates/reset.php?id={$user['id']}&token=$reset_token");
            header('Location: login.php');
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
        }
    }

?>

<h1>Mot de passe oublié</h1>

<div class="formInsert">
    <form action="" method="POST">
        <div class="form-group">
            <p>Pour réinitialiser votre mot de passe, veuillez indiquer votre mail.</p>
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" required//>
        </div>
        <input type="submit" class="btn btn-info offset-lg-5" value="Envoi"></button>
    </form>
</div>

<?php require_once ('../inc/footer.php'); ?>
