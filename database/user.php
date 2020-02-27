<?php

    require_once ('database.php');
    include ('../inc/functions.php');

    // Déclaration d'une class User qui hérite de la class Database
    class User extends Database
    {
        public function insertUser($username, $email, $password){
            $database = $this->getDatabase();
            $request = $database->prepare('INSERT INTO user SET username = ?, email = ?, password = ?, confirmation_token = ?');
            $password = password_hash($password, PASSWORD_BCRYPT);
            $token = str_random(60);
            $request->execute([$username, $email, $password, $token]);

            // Nous génère le dernier Id entré
            $user_id = $database->lastInsertId();
            mail($email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\n
            http://127.0.0.1:8080/library/templates/confirm.php?id=$user_id&token=$token");

            // On lance une session qui enregistre des messages dans $_SESSION
            session_start();
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
            header('Location: login.php');
            exit();

        }

        public function matchUserName($username){
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT id FROM user WHERE username = ?');
            $request->execute([$username]);
            $userId = $request->fetch();
            if($userId){           
                return "alreadyUsernameExist";
            }
        }

        public function matchEmail($email){
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT id FROM user WHERE email = ?');
            $request->execute([$email]);
            $userId = $request->fetch();
            if($userId){           
                return "alreadyEmailExist";
            }
        }
        
        // On déclare une function qui vérifie que l'utilisateur a bien accéder à la page de confirmation d'inscription via 
        // le lien indiqué dans le mail contennat son token et son id
        public function confirmToken($user_id, $token){
            
            $database = $this->getDatabase();
            $request = $database->prepare('SELECT * FROM user WHERE id = ?');
            $request->execute([$user_id]);
            $user = $request->fetch();
            session_start();

            // Si le token ne match pas, on le redirige vers la page login
            if($user && $user['confirmation_token'] == $token){
                $database->prepare('UPDATE user SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
                $_SESSION['auth'] = $user;
                $_SESSION['flash']['success'] = 'Vous êtes bien connecté à votre compte';
                header('Location: account.php');
            }else{
                $_SESSION['flash']['danger'] = "Ce token n'est plus valide";                        
                header('Location: login.php');
            }
        }   
    }

?>