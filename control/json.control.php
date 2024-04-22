<?php
require_once("../config.php");
try {

    $db = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=" . DB_PORT, DB_LOGIN, DB_PWD);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

} catch (Exception) {
    die($errorMessage = "Problem connecting to the DB");
}

json_encode(getMapMarkersForJson($db));



function getMapMarkersForJson(PDO $map) : array | string {
    $sql = "SELECT * 
            FROM `map`
            ORDER BY `map_id`";
        try{
            $query = $map->query($sql);
            $markers = $query->fetchAll();
            $query->closeCursor();
            var_dump($markers);
            return $markers;
        
        }catch(Exception) {
            $errorMessage = "Sorry, something went wrong getting markers";
            return $errorMessage;
        }
    }