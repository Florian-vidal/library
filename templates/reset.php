<?php

    require_once ('../inc/header.php');
    require_once ('../database/user.php');
    require_once ('../database/database.php');
    $newDatabase = new Database;
    $database = $newDatabase->getDatabase();

    if(isset($_GET['id']) && isset($_GET['token'])){
        $request = $database->prepare('SELECT * FROM user WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
        $request->execute([$_GET['id'], $_GET['token']]);
        $user = $request->fetch();
        if($user){
            if(!empty($_POST)){
                if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $database->prepare('UPDATE user SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                    session_start();
                    $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                    $_SESSION['auth'] = $user;
                    header('Location: account.php');
                    exit();
                }
            }
        }else{
            session_start();
            $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
            header('Location: login.php');
            exit();
        }
    }else{
        header('Location: login.php');
        exit();
    }

?>


<div class="formInsert">
<form action="" method="POST">
    <div class="form-group">
        <label for="password">Votre nouveau mot de passe</label>
        <input type="text" name="password" class="form-control" id="password" />
    </div>
    <div class="form-group">
        <label for="password_confirm">Confirmation de mot de passe</label>
        <input type="text" name="password_confirm" class="form-control" id="password_confirm" />
    </div>
    <input type="submit" class="btn btn-primary" value="Réinitialiser le mot de passe"></button>
</form>
</div>