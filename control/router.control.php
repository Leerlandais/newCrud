<?php
if(isset($_GET["page"])) {
    switch("page") {
        case "home" : 
            $title = "Welcome";
            include("../view/home.view.php");
            break;
        default :
        $title = "Page Not Found";
            include("../view/error404.view.php");
    }
}else {
    $title = "Welcome";
    include("../view/home.view.php");
}