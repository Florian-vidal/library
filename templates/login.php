<?php
    require_once ('../inc/header.php');
    require_once ('../database/user.php');
    require_once ('../database/database.php');
    require_once ('../inc/functions.php');
    $newDatabase = new Database;
    $database = $newDatabase->getDatabase();
    reconnect_from_cookie();
?>

<?php 

    // On vérifie que si les champs ne sont pas vides et qu'ils correspondent aux identifiants entrés par le même utilisateur avant
    if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
        $request = $database->prepare('SELECT * FROM user WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $request->execute(['username' => $_POST['username']]);
        $user = $request->fetch();
        if($user == null){
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
        }elseif(password_verify($_POST['password'], $user['password'])){
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
            if($_POST['remember']){
                $remember_token = str_random(250);
                $database->prepare('UPDATE user SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user['id']]);
                setcookie('remember', $user['id'] . '==' . $remember_token . sha1($user['id'] . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
            }
            header('Location: account.php');
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
            header('Location: login.php');
            exit();
        }
    }

?>

<h1>Se connecter</h1>

<div class="formInsert">
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Pseudo ou email</label>
            <input type="text" name="username" class="form-control" id="username" required/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe <a href="forget.php">(J'ai oublié mon mot de passe)</a></label>
            <input type="text" name="password" class="form-control" id="password" required/>
        </div>
        <div class="form-group">
            <label for="">
                <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
            </label>
        </div>

        <button type="submit" class="btn btn-info offset-lg-5">Se connecter</button>
    </form>
</div>

<?php require_once ('../inc/footer.php'); ?>
