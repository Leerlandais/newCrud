<?php

$getUse = getUsers($db);

if(isset($_GET["p"])) {
    
    switch($_GET["p"]) {
        case "home" : 
            $title = "Welcome";
            include("../view/home.view.php");
            break;
            case "read" : 
                $title = "Read Articles";
                include("../view/articles.view.php");
                break;    
            case "refuse" : 
                $title = "Access Denied";
                include("../view/refuse.view.php");
                break;   
            case "add_art" : 
                $title = "Add an Article";
                include("../view/addArticles.view.php");
                break;                            
                default :
                $title = "Page Not Found";
                include("../view/error404.view.php");
                break;
            }
        }else {
            $title = "Welcome via else";
            include("../view/home.view.php");
        }
        
        if (isset($_GET['sect']) && $_GET["sect"] === "logout") {
            include ("../model/logout.model.php");
        } 
        
        
        if(isset($_POST["userNameInp"]) && isset($_POST["userPassInp"])) {
          $userLogin = getUserLogin($db, $_POST["userNameInp"]);
          if (!is_array($userLogin)) {
                var_dump($userLogin);
                return;
          }
          checkUserLogin($db, $userLogin, $_POST["userPassInp"]);
          
        }
            