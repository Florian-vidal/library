<?php 
    if(isset($_GET['newSearch'])){
        $searchContent = $_GET['newSearch'];
        $newSearch -> searchContent($searchContent);           
    }