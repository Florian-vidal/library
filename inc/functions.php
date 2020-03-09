<?php

    // Permet d'afficher des erreurs lors du remplissage des champs du formulaire d'inscription
    function debug($errors){
        echo'<pre>' .print_r($errors, true) . '</pre>';
    }

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    // Permet de vérifier que s'il y a absence d'identifiants, alors un message d'erreur s'affiche avec une redirection
    function logged_only(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['auth'])){
            $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
            header('Location: login.php');
            exit();
        }
    }

    // SI jamais un cookie est défini et qu'une session n'est pas en cours
    function reconnect_from_cookie(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if(isset($_COOKIE['remember']) && !isset($_SESSION['auth']) ){
            require_once '../database/database.php';
            if(!isset($database)){
                global $database;
            }
            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $user_id = $parts[0];
            $request = $database->prepare('SELECT * FROM user WHERE id = ?');
            $request->execute([$user_id]);
            $user = $request->fetch();
            
            // Si l'utilisateur est trouvé, on le connecte
            if($user){
                $expected = $user_id . '==' . $user['remember_token'] . sha1($user_id . 'ratonlaveurs');
                if($expected == $remember_token){
                    session_start();
                    $_SESSION['auth'] = $user;
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);

                // Si l'utilisateur ne correspond pas, je détruit le cookie
                } else{
                    setcookie('remember', null, -1);
                }
            }else{
                setcookie('remember', null, -1);
            }
        }
    }

    

?>