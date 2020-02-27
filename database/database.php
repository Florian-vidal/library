<?php

    // Retourne une connexion à la base de données
    class Database{
        
        function getDatabase(): PDO
        {
            $database = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'root', 'root');
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $database;
        }
    }

?>
