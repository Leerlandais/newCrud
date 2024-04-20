<?php

$getUse = getUsers($db);

if(isset($_GET["p"]) && $_GET["p"] === "read") {
    $status = 2;
        $readableArts = getAllArts($db, $status);
}

if(isset($_GET["p"]) && $_GET["p"] === "cont_arts") {
    $status = 0;
        $controlArts = getAllArts($db, $status);
    $status = 2;
        $readableArts = getAllArts($db, $status);        
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
                                    case "make_login" : 
                                        $title = "Création d'utilisateur";
                                        include("../view/home.view.php");
                                        break;
                                        case "banish" : 
                                            $title = "Go Away";
                                            include("../view/banish.view.php");
                                            break;  
                                            case "carte" : 
                                                $title = "Playing With Map and Locations";
                                                include("../view/carte.view.php");
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
        
        
        if(isset($_POST["userNameInp"], $_POST["userPassInp"])) {
            if($_POST["userNameInp"] == "" || $_POST["userPassInp"] == "") {
                echo "Saisissez correctement vos coordonnées!";
                return;

            }
          $userLogin = getUserLogin($db, $_POST["userNameInp"], $_POST["userPassInp"]);
          if (!is_bool($userLogin)) {
            echo $userLogin;
          }else if ($_SESSION["level"] === 0) {
            header ("Location: ?p=banish");
            die();
          }else {
            header ("Location: ?p=welcome");
          }
          
   //       checkUserLogin($userLogin, $_POST["userPassInp"]);
          
        }

        if(isset($_POST["createNameInp"], $_POST["createPassInp"], $_POST["createPassInpCheck"])) {
            if($_POST["createNameInp"] == "" || $_POST["createPassInp"] == "" || $_POST["createPassInpCheck"] == "") {
                echo "Saisissez correctement vos coordonnées!";
                return;
            }else if ($_POST["createPassInp"] !== $_POST["createPassInpCheck"]) {
                echo "Vos mots de passe ne correspondent pas!";
                return;
            }else {
            $createLogin = createNewUser($db, $_POST["createNameInp"], $_POST["createPassInp"]);
        }
        }




if(isset($_POST["unpublish"])) {
    changeArticleStatusDown($db, $_POST["artID"]);
    echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST["publish"])) {
    changeArticleStatusUp($db, $_POST["art_ID"]);
    echo "<meta http-equiv='refresh' content='0'>";   
}
if(isset($_POST["abolish"])) {
    changeArticleStatusDelete($db, $_POST["art_ID"]);
    echo "<meta http-equiv='refresh' content='0'>";   
}

if(isset($_POST["userUp"])) {
    changeUserStatusUp($db, $_POST["id"]);
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST["userDown"])) {
    changeUserStatusDown($db, $_POST["id"]);
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST["userDelete"])) {
    deleteUserFromDB($db, $_POST["id"]);
    echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST["art_title"], $_POST["art_cont"])) {   
 $addedArt = addNewArticle($db, $_POST["art_title"], $_POST["art_cont"], $_POST["art_slug"], $_SESSION["userID"]);
 echo "<meta http-equiv='refresh' content='0'>";
}