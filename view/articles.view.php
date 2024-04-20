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
        <p class="h1 my-5">Les Articles</p>
        <?php
            if(isset($_SESSION["level"]) && $_SESSION['level'] == 8)
            {
                echo "hi Boss";
            }        
        ?>
        </div>
    </div>

    <div class="row gx-5 mt-5 me-5">
        <div class="col mb-4 d-flex flex-row">
            <div class="col d-flex flex-column">
            <?php
            if (is_array($readableArts)) {
                foreach ($readableArts as $arts) { ?>
                      <a href="?p=read&show_art=<?=$arts["art_id"]?>" class="link-underline link-secondary">
                      <h4><strong><?=$arts["art_title"]?></strong></h4>
                      </a>
                      <p class="ps-3 m-0">
                        <?=$arts["small_cont"] ?>...
                      </p>
                      <p class="h6 text-primary d-flex align-self-end"><small><?=$arts["art_date"]?></p></small>
                      <?php
                }
            }else {
                echo $readableArts;
            }
            ?>
            </div>
            <div class="col d-flex flex-column ms-5 border border-secondary rounded-4 px-5 text-center">
            <?php
            if (isset($_GET["show_art"])) {
                foreach ($readableArts as $arts) { 
                    if ($_GET["show_art"] == $arts["art_id"]) {
                        ?>
                <div class="row d-flex flex-column mt-4">
                    <p class="h3"><?=$arts["art_title"]?></p>
                    <p><?=$arts["art_content"]?></p>
                </div>
                </div>
                <?php
                }
            }
        }else { ?>
            <div class="row d-flex flex-column mt-4">
            <p class="h3">Cliquez sur un article pour l'afficher ici</p>
            
        </div>
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