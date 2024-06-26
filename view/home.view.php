<?php
if(isset($_SESSION['log'])) $_SESSION['log'][] = $_SERVER['REMOTE_ADDR']. " | ". date("Y-m-d H:i:s") . " | ". __FILE__."\n";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../public/styles/style.css">
        <title><?=$title?></title>
    </head>
    <body>
    <div class="container mt-2 d-flex flex-column align-items-center h-auto">
        <div class="row">
            <div class="col text-center">
                <p class="h1 mt-5">Bienvenue dans ma nouvelle expérience CRUD et Bootstrap<p>
        <?php
        if (isset($errorMessage)) : echo $errorMessage; endif;
        include("inc/header.php");
            if (!isset($_SESSION['monID']) || $_SESSION['monID']!== session_id()) {
        ?>
                <p class="h3">Connectez-vous pour continuer</p>
                <p class="h5">ou cliquez <a href="?p=read">ici</a> pour lire les articles</p>
                <?php

include("inc/intro.php");
?>
                <?php } 
                
                if (isset($_GET["p"]) && $_GET["p"] === "make_login") {
                    include("inc/makeUser.php");
                }else if(!isset($_SESSION['monID']) || 
            $_SESSION['monID']!== session_id())
            {
                include("inc/login.php");
            }
            ?>
            </div>    
        </div>
    </div>
    <!--                                                        WHY DOES ADDING THIS OR THE INC/HEADER.PHP VERSION MAKE THE HEADER GO NUTS?????????????

        -->
    <?php

            include("inc/footer.php");
        ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>