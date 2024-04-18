<?php

$getUse = getUsers($db);

if(isset($_GET["p"]) && $_GET["p"] === "read") {
    $status = 2;
        $readableArts = getAllArts($db, $status);
}

if(isset($_GET["p"]) && $_GET["p"] === "cont_arts") {
    $status = 0;
        $controlArts = getAllArts($db, $status);
}


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
                        case "cont_arts" : 
                            $title = "Control Articles";
                            include("../view/controlArticles.view.php");
                            break;   
                            case "cont_user" : 
                                $title = "Control Users";
                                include("../view/controlUsers.view.php");
                                break;    
                                case "welcome" : 
                                    $title = "Bienvenue";
                                    include("../view/welcome.view.php");
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
            if($_POST["userNameInp"] == "" || $_POST["userPassInp"] == "") {
                echo "Enter you details correctly!";
                return;

            }
          $userLogin = getUserLogin($db, $_POST["userNameInp"], $_POST["userPassInp"]);
          if (!is_bool($userLogin)) {
            echo $userLogin;
          }else {
            header ("Location: ?p=welcome");
          }
          
   //       checkUserLogin($userLogin, $_POST["userPassInp"]);
          
        }
        
