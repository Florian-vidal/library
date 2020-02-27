<?php 

    require_once ('../inc/header.php');

    // La fonction debug, qui se trouve dans le fichier functions.php, utilisée sur cette page ligne 51 est inclue dans la classe user appelée ici dans la ligne 11, par héritage, nous n'avons pas à re inclure le fichier functions sur cette page
    // include ('../inc/functions.php');
    require_once ('../database/user.php');

    $newUser = new User;

    
    if(!empty($_POST)){

        // On créé un tableau qui se remplie d'erreurs si certains champs sont mal renseignés
        $errors = array();

        // Si le champs username n'est pas renseigné ou mal renseigné, un message d'erreur apparaît
        if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
            $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
        }else{

            // Sinon, j'appellle la function matchUsername qui vérifie si le pseudo est déjà pris
            $username = $_POST['username'];
            if ($newUser->matchUsername($username) == "alreadyUsernameExist"){
                $errors['username'] = "Ce pseudo est déjà pris";
            }           
        }

        // Si le champs email et le filtre n'est pas validé, un message d'erreur apparaît
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Votre email n'est pas valide";
        }else{

            // Sinon, j'appelle la function matchEmail qui vérifie si le mail est déjà pris
            $email = $_POST['email'];
            if ($newUser->matchEmail($email) == "alreadyEmailExist"){
                $errors['email'] = "Cet email est déjà pris pour ce compte";
            }  
        }

        // Si le champs password n'est pas validé, un message d'erreur apparaît
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
            $errors['password'] = "Vous devez rentrer un mot de passe valide";
        }

        // On appelle la function définié dans function.php qui gère l'affichage des erreurs de remplissage de champs
        debug($errors);
        
        // Si l'array errors ne contient pas d'erreur, appel de la function insertUser
        if (empty($errors)){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $newUser->insertUser($username, $email, $password);
        }
    }
 
?>

<h1>S'inscrire</h1>

<?php if (!empty($errors)):?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>

        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="formInsert">
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Pseudo</label>
            <input type="text" name="username" class="form-control" id="username" required/>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" class="form-control" id="password" required/>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmez votre mot de passe</label>
            <input type="text" name="password_confirm" class="form-control" id="password_confirm" required/>
        </div>
        <input type="submit" class="btn btn-primary" value="M'inscrire"></button>
    </form>
</div>

<?php
    require_once ('../inc/footer.php');
?>