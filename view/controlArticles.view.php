<?php
    if (!isset($_SESSION["level"]) || $_SESSION["level"] < 3) {
        header ("Location: ?p=refuse");
        exit();
    }
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
    <div class="container mt-2 h-50">
        <div class="row">
            <div class="col text-center">
        <?php
           if (isset($errorMessage)) : echo $errorMessage; endif;
        include("inc/header.php");
    
        ?>
        <p class="h1 mt-5">Contrôler les Articles</p>

        </div>
    </div>
        <div class="row d-flex flex-row text-center">
            <div class="col border border-success-subtle px-5 d-flex flex-column align-items-center">
                <p class="h3 mb-4">Articles Publié</p>
                <?php
                if (is_array($readableArts)) {      /*  */
                foreach ($readableArts as $arts) { ?> 
                <form action="" method="POST">
                    <div class="col d-flex flex-row border border-1 border-primary-subtle rounded-5 px-2 py-1 mb-2">
                        <input type="hidden" name="artID" value="<?=$arts["art_id"]?>"> 
                    <p class="h4 font-weight-bold"><?=$arts["art_title"]?></p>
                    <button class="badge bg-success text-warning btn-sm h-auto w-auto align-self-center ms-3 border-info" type="submit" name="unpublish">Masquer</button>
                    </div>
                    </form>
                    
                    <?php
                }
            }else {
                echo $readableArts;
            }
            ?>
            </div>
            
            <div class="col border border-success-subtle px-5 d-flex flex-column align-items-center">
                <p class="h3 mb-4">Articles à Verifer</p>
                <?php

/* CHANGE LINKS TO BUTTONS AND USE POST METHOD */

            if (is_array($controlArts)) {
                foreach ($controlArts as $arts) { ?>
                <form action="" method="POST">
                    <div class="row mb-4 d-flex flex-row border border-1 border-primary-subtle rounded-5 px-2 py-1">
                        <div class="col px-2 py-1">
                        <input type="hidden" name="art_ID" value="<?=$arts["art_id"]?>"> 
                           <a href="?p=cont_arts&show_art=<?=$arts["art_id"]?>" class="link-underline link-underline-opacity-0"><p class="h4 font-weight-bold m-0"><?=$arts["art_title"]?></p></a> 
                        <p class="text-muted ps-1"><?=$arts["art_content"] ?>
                        </p>
                        </div>
                
                        <button class="badge bg-success text-warning btn-sm h-auto w-auto align-self-center ms-3 border-info" type="submit" name="publish">Publier</button>                
                        <button class="badge bg-dark text-danger btn-sm h-auto w-auto align-self-center ms-3 border-warning" type="submit" name="abolish">Effacer</button>  
                        </div>
                        </form>
                        <?php
                }
            }


            ?>
            </div>
            <?php
            if (isset($_GET["show_art"])) {
                foreach ($controlArts as $arts) { 
                    if ($_GET["show_art"] == $arts["art_id"]) {
                ?>
                <div class="row d-flex flex-column justify-content-center mt-4">
                    <p class="h3"><?=$arts["art_title"]?></p>
                    <p><?=$arts["art_content"]?></p>
                </div>
                <?php
                }
                }
            }
            if ($_SESSION["level"] === 8) {
                if (is_array($deleteArts)) { ?>
                <div class="row border border-danger rounded-5 mt-3">
                     <p class="h3 mb-4">Articles à Effacer</p>
                <?php
                    foreach ($deleteArts as $arts) { ?>
                    <form action="" method="POST" class="d-flex flex-row justify-content-center">
                        <div class="row mb-4 d-flex flex-row border border-1 border-warning rounded-5 px-2 py-1 w-50">
                            <div class="col px-2 py-1">
                            <input type="hidden" name="del_ID" value="<?=$arts["art_id"]?>"> 
                               <a href="?p=cont_arts&show_art=<?=$arts["art_id"]?>" class="link-underline link-underline-opacity-0"><p class="h4 font-weight-bold m-0"><?=$arts["art_title"]?></p></a> 
                            <p class="text-muted ps-1"><?=$arts["art_content"] ?>
                            </p>
                            </div>
                    
                            <button class="badge bg-success text-warning btn-sm h-auto w-auto align-self-center ms-3 border-info" type="submit" name="republish">Re-Publier</button>                
                            <button class="badge bg-dark text-danger btn-sm h-auto w-auto align-self-center ms-3 border-warning" type="submit" name="deleteArt">Effacer</button>  
                            </div>
                            </form>
                            <?php
                    }
                }
                ?>
                <?php
            }
            ?>
            </div>
        </div>
            </div>
      
        <?php
            include("inc/footer.php");
        ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>