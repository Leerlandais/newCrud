<?php

function getMapMarkers(PDO $map) : array | string {
$sql = "SELECT * 
        FROM `map`
        ORDER BY `map_id`";
    try{
        $query = $map->query($sql);
        $markers = $query->fetchAll();
        $query->closeCursor();
        
        return $markers;
    
    }catch(Exception) {
        $errorMessage = "Sorry, something went wrong getting markers";
        return $errorMessage;
    }
}