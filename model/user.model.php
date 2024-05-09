<?php

function getUsers(PDO $db) {
    
    $sql = "SELECT user_name AS nom, user_lvl AS lvl, user_id AS id, user_marker AS mark
            FROM users_crud
            ORDER BY user_name ASC";
    
    try{
        $query = $db->query($sql);
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }catch(Exception) {
        $errorMessage = "Sorry, couldn't get user info";
        return $errorMessage;
    }

}

function getUserLogin(PDO $db, $user, $pwd) {
    $cleanedUser = htmlspecialchars(strip_tags(trim($user)), ENT_QUOTES);
  //  $cryptPWD = password_hash($pwd,PASSWORD_DEFAULT);                 TOOK AGES TO REALISE THAT I DIDN'T NEED TO HASH THE INPUT!!!!
    $sql = "SELECT * FROM `users_crud` WHERE `user_name` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $errorMessage = "Please enter your details correctly";
        return $errorMessage;
    }

    if (password_verify($pwd, $result['user_pwd'])) {
        $_SESSION['monID'] = session_id();
        $_SESSION['name'] = $result["user_name"];
        $_SESSION["level"] = $result['user_lvl'];
        $_SESSION["userID"] = $result["user_id"];
        $_SESSION['log'][] = $_SERVER['REMOTE_ADDR']. " | ". date("Y-m-d H:i:s") . " | ". __FILE__."\n";
        return true;
    } else {
        $errorMessage = "Incorrect Password";
        return $errorMessage;
    }
}

function createNewUser(PDO $db, $name, $pwd) {
    $cleanedName = htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES);
    $cryptPWD = password_hash($pwd,PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users_crud`(`user_name`, `user_pwd`, `user_lvl`) VALUES (?,?,'2')";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedName);
    $stmt->bindValue(2, $cryptPWD);

    try{
        $stmt->execute();
        return true;

    }catch(Exception){
        $errorMessage = "Couldn't create user";
        return $errorMessage;
    }
}

function changeUserStatusUp(PDO $db, $thisUser) {
    
    $sql = "UPDATE `users_crud` SET `user_lvl` = `user_lvl` +1 WHERE user_id = $thisUser";
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
    
    $sql = "UPDATE `users_crud` SET `user_lvl` = `user_lvl` -1 WHERE user_id = $thisUser";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function deleteUserFromDB(PDO $db, $delUser) {
    if ($delUser === "1" || $delUser === "2") {
        echo "not a hope";
    }else {
    $sql = "DELETE FROM `users_crud` 
            WHERE `user_id` = $delUser";
    $delete = $db->prepare($sql);
    try {
        $delete->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Delete User";
        return $errorMessage;
    }
}
}

