<?php

/**
 * Retourne une connexion à la base de données
 *
 * @return PD0
 */
class Database{
    
    function getDatabase(): PDO
    {
        $database = new PDO('mysql:host=localhost;dbname=library;charset=utf8', 'root', 'root');   
        return $database;
    }
}
