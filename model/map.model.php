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


function addMapMarkerForUser (PDO $markMap, $lat, $lon, $name, $id) {
    
    $cleanedLat = htmlspecialchars(strip_tags(trim($lat)), ENT_QUOTES);
    $cleanedLon = htmlspecialchars(strip_tags(trim($lon)), ENT_QUOTES);
    $cleanedName = htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES);
    
    $sqlMark = "INSERT INTO `map`(`map_user`, `map_lat`, `map_long`, `map_name`) 
                VALUES (?,?,?,?)";
    
    $stmtMark = $markMap->prepare($sqlMark);
    $stmtMark->bindValue(1, $id);
    $stmtMark->bindValue(2, $cleanedLat);
    $stmtMark->bindValue(3, $cleanedLon);
    $stmtMark->bindValue(4, $cleanedName);

    $sqlUser = "UPDATE `users` 
                SET `user_marker`='1' 
                WHERE `user_id` = ?";

    $stmtUser = $markMap->prepare($sqlUser);
    $stmtUser->bindValue(1, $id);

    try {

        $stmtUser->execute();
        $stmtMark->execute();
        $markMap->commit();
        return true;

    } catch (Exception) {

        $errorMessage = "Sorry, couldn't add your marker";
        return $errorMessage;
    }
}


function updateMapMarkerForUser (PDO $updateMap, $lat, $lon, $name, $id) {
    $cleanedLat = htmlspecialchars(strip_tags(trim($lat)), ENT_QUOTES);
    $cleanedLon = htmlspecialchars(strip_tags(trim($lon)), ENT_QUOTES);
    $cleanedName = htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES);

    $sqlUpdate = "UPDATE `map` 
                  SET `map_lat`= ?,`map_long`= ?,`map_name`= ? 
                  WHERE `map_user` = ?";

    $stmtUpdate = $updateMap->prepare($sqlUpdate);
    $stmtUpdate->bindValue(1, $cleanedLat);
    $stmtUpdate->bindValue(2, $cleanedLon);
    $stmtUpdate->bindValue(3, $cleanedName);
    $stmtUpdate->bindValue(4, $id);

    try {

        $stmtUpdate->execute();
        $updateMap->commit();
        return true;

    } catch (Exception) {

        $errorMessage = "Sorry, couldn't change your marker";
        return $errorMessage;
    }

}