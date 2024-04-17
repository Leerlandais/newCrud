<?php

function getUsers(PDO $db) {
    
    $sql = "SELECT user_name AS nom
            FROM users
            ORDER BY user_lvl DESC";
    
    try{
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }catch(Exception) {
        $errorMessage = "Sorry, couldn't get user info";
        return $errorMessage;
    }

}