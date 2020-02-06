<?php

require_once ('database.php');

/**
 * Déclaration d'une classe Author qui hérite de la classe Database
 */
class Author extends Database
{
    public function indexAuthor()
    {
        $database = $this->getDatabase();
        $request = $database->query('SELECT * FROM author');
        $results = $request->fetchAll();

        return $results;
    }
}

?>