<?php

    require_once ('database.php');
    require_once ('book.php');
    require_once ('author.php');

    class Search extends Database 
    {
        public function searchContent($newSearch){
            $database = $this->getDatabase();
            $results = [];
            $request = $database->prepare('SELECT * FROM book WHERE title LIKE ?');
            $request->execute(["%".$newSearch."%"]);           
            $results = $request->fetchAll();
            return $results;       
        }
    }