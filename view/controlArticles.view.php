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
        <?php
            if(isset($_SESSION["level"]) && $_SESSION['level'] == 8)
            {
                echo "hi Boss";
            }
        
        ?>
        </div>
    </div>
        <div class="row d-flex flex-row text-center">
            <div class="col border border-success-subtle px-5 d-flex flex-column align-items-center">
                <p class="h3 mb-4">Articles Publié</p>
                <?php
                if (is_array($readableArts)) {
                foreach ($readableArts as $arts) { ?>
                    
                    <p class="h4 font-weight-bold"><?=$arts["art_title"]?></p>
                    <p class="text-muted ps-3">
                        <?=$arts["art_content"] ?>
                    </p>
                    
                    
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
            if (is_array($controlArts)) {
                foreach ($controlArts as $arts) { ?>
                    <div class="col-md-6 mb-4">
                        <p class="h4 font-weight-bold"><?=$arts["art_title"]?></p>
                        <p class="text-muted ps-3">
                            <?=$arts["art_content"] ?>
                        </p>
                    </div>
                </div>
                <?php
                }
            }
            ?>
            </div>
        </div>
        <?php
            include("inc/footer.php");
        ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>