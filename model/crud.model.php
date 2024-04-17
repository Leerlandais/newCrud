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

function getUserLogin ($db, $user) {
    $cleanedUser = htmlspecialchars(strip_tags(trim($user)), ENT_QUOTES);

    $sql = "SELECT * from `users`
            WHERE `user_name` = '$cleanedUser'";

            try {
                $query = $db->query($sql);
                $result = $query->fetch();
                return $result;
            } catch (Exception $e) {
                error_log("Error adding User: " . $e->getMessage());
                return $e;
    }
}

function checkUserLogin ($db, $user, $pwd) {
    $cleanedPWD = htmlspecialchars(strip_tags(trim($pwd)), ENT_QUOTES);
        if ($user["user_pwd"] === $cleanedPWD) {
            var_dump($user, $user, $user);
        }
    
}