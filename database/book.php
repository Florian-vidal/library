<?php

require_once ('database.php');

/**
 * Déclaration d'une classe Book qui hérite de la classe Database
 */
class Book extends Database
{
    public function indexBook()
    {
        $database = $this->getDatabase();
        $request = $database->query('SELECT * FROM book');
        $results = $request->fetchAll();

        return $results;
    }
}

?>