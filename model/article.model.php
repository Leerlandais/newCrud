<?php

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

function changeArticleStatusFlag(PDO $db, $changeThis) {
    
    $sql = "UPDATE `articles` SET `art_status` = 1 WHERE art_id = $changeThis";
    $stmt = $db->prepare($sql);

    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Update Article Status";
        return $errorMessage;
    }
}

function deleteArticleForever(PDO $db, $artID) {
    $sql = "DELETE FROM `articles`
            WHERE `art_id` = $artID";

    $stmt = $db->prepare($sql);
    try {
        $stmt->execute();
        return true;

    }catch(Exception) {
        $errorMessage = "Couldn't Delete Article";
        return $errorMessage;
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


