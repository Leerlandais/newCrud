<?php

function getUsers(PDO $db) {
    
    $sql = "SELECT user_name AS nom, user_lvl AS lvl, user_id AS id
            FROM users
            ORDER BY user_lvl DESC";
    
    try{
        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $result;
    }catch(Exception) {
        $errorMessage = "Sorry, couldn't get user info";
        return $errorMessage;
    }

}

function getAllArts(PDO $db, $status) {
    $cleanedStat = htmlspecialchars(strip_tags(trim($status)), ENT_QUOTES);
    $sql = "SELECT * 
            FROM `articles`
            WHERE `art_status` = ?";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedStat);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }catch(Exception) {
        $errorMessage = "Sorry, couldn't get articles";
        return $errorMessage;
    }

}
function getUserLogin (PDO $db, $user, $pwd) {
    $cleanedUser = htmlspecialchars(strip_tags(trim($user)), ENT_QUOTES);
    $cleanedPWD = htmlspecialchars(strip_tags(trim($pwd)), ENT_QUOTES);
    $sql = "SELECT * from `users`
            WHERE `user_name` = '$cleanedUser'";

        $query = $db->query($sql);
        $result = $query->fetch();
if (is_bool($result)){
        $errorMessage = "Sorry, couldn't find that user";
        return $errorMessage;
    }
        if ($result["user_pwd"] === $cleanedPWD) {
            $_SESSION['monID'] = session_id();
            $_SESSION['name'] = $result["user_name"];
            $_SESSION["level"] = $result['user_lvl'];
            $query->closeCursor();
            return true;
        }else {
            
        $errorMessage = "Incorrect Password";
        return $errorMessage;

    }

}

function createNewUser(PDO $db, $name, $pwd) {
    $cleanedName = htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES);
    $cleanedPWD = htmlspecialchars(strip_tags(trim($pwd)), ENT_QUOTES);
    // var_dump($cleanedName,$cleanedPWD);



    $sql = "INSERT INTO `users`(`user_name`, `user_pwd`, `user_lvl`) VALUES (?,?,'2')";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedName);
    $stmt->bindValue(2, $cleanedPWD);

    try{
        $stmt->execute();
        return true;

    }catch(Exception){
        $errorMessage = "Couldn't create user";
        return $errorMessage;
    }
}




function changeArticleStatusDown(PDO $db, $changeThis) {
    
    $sql = "UPDATE `articles` SET `art_status` = `art_status` -2 WHERE art_id = $changeThis";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function changeArticleStatusUp(PDO $db, $changeThis) {
    
    $sql = "UPDATE `articles` SET `art_status` = `art_status` +2 WHERE art_id = $changeThis";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function changeUserStatusUp(PDO $db, $thisUser) {
    
    $sql = "UPDATE `users` SET `user_lvl` = `user_lvl` +1 WHERE user_id = $thisUser";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function changeUserStatusDown(PDO $db, $thisUser) {
    
    $sql = "UPDATE `users` SET `user_lvl` = `user_lvl` -1 WHERE user_id = $thisUser";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

