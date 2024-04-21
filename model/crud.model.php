<?php

function getUsers(PDO $db) {
    
    $sql = "SELECT user_name AS nom, user_lvl AS lvl, user_id AS id, user_marker AS mark
            FROM users
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

function getAllArts(PDO $db, $status) {
    $cleanedStat = htmlspecialchars(strip_tags(trim($status)), ENT_QUOTES);
    $sql = "SELECT  SUBSTRING(art_content, 1, 40) AS small_cont, art_content, art_id, art_title, art_slug, art_date, users.user_name AS nom, art_status
            FROM `articles`
            LEFT JOIN `users`
            ON `users`.`user_id` = `articles`.`art_author`
            WHERE `art_status` = ?
            ORDER BY art_date DESC";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedStat);
    try{
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }catch(Exception) {
        $errorMessage = "Sorry, couldn't get articles";
        return $errorMessage;
    }

}
function getUserLogin(PDO $db, $user, $pwd) {
    $cleanedUser = htmlspecialchars(strip_tags(trim($user)), ENT_QUOTES);
  //  $cryptPWD = password_hash($pwd,PASSWORD_DEFAULT);                 TOOK AGES TO REALISE THAT I DIDN'T NEED TO HASH THE INPUT!!!!
    $sql = "SELECT * FROM `users` WHERE `user_name` = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(1, $cleanedUser);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $errorMessage = "Sorry, couldn't find that user";
        return $errorMessage;
    }

    if (password_verify($pwd, $result['user_pwd'])) {
        $_SESSION['monID'] = session_id();
        $_SESSION['name'] = $result["user_name"];
        $_SESSION["level"] = $result['user_lvl'];
        $_SESSION["userID"] = $result["user_id"];
        return true;
    } else {
        $errorMessage = "Incorrect Password";
        return $errorMessage;
    }
}

function createNewUser(PDO $db, $name, $pwd) {
    $cleanedName = htmlspecialchars(strip_tags(trim($name)), ENT_QUOTES);
    $cryptPWD = password_hash($pwd,PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users`(`user_name`, `user_pwd`, `user_lvl`) VALUES (?,?,'2')";
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




function changeArticleStatusDown(PDO $db, $changeThis) {
    
    $sql = "UPDATE `articles` SET `art_status` = 0 WHERE art_id = $changeThis";
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
    
    $sql = "UPDATE `articles` SET `art_status` = 2 WHERE art_id = $changeThis";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function changeArticleStatusDelete(PDO $db, $changeThis) {
    
    $sql = "UPDATE `articles` SET `art_status` = 8 WHERE art_id = $changeThis";
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

function deleteUserFromDB(PDO $db, $delUser) {
    if ($delUser === "1" || $delUser === "2") {
        echo "not a hope";
    }else {
    $sql = "DELETE FROM `users` 
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


function addNewArticle(PDO $db, $title, $content, $slug, $name) {

    $cleanedTitle = htmlspecialchars(strip_tags(trim($title)), ENT_QUOTES);
    $cleanedCont = htmlspecialchars(strip_tags(trim($content)), ENT_QUOTES);
    $cleanedSlug = htmlspecialchars(strip_tags(trim($slug)), ENT_QUOTES);

    $sql = "INSERT INTO `articles`(`art_title`, `art_content`, `art_slug`, `art_author`, `art_status`) 
            VALUES (:tit, :cont, :slug, :nom, 0)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':tit', $cleanedTitle);
    $stmt->bindParam(':cont', $cleanedCont);
    $stmt->bindParam(':slug', $cleanedSlug);
    $stmt->bindParam(':nom', $name);

    try {
        $stmt->execute();
        $_SESSION["artAdded"] = true;
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Add Article";
        return $errorMessage;
    }
}


