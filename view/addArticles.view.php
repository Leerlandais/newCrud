<?php
    if (!isset($_SESSION["level"]) || $_SESSION["level"] < 2) {
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
    <div class="container mt-2 h-auto">
        <div class="row">
            <div class="col text-center">
        <?php
           if (isset($errorMessage)) : echo $errorMessage; endif;
        include("inc/header.php");
        echo ($_SESSION["name"]);
        ?>
        <p class="h1 mt-5">Ajouter un Article</p>
        
        </div>
    </div>
        
            <form action="" method="POST">
                <div class="form-group">
                
                <label for="art_title">Titre : </label>
                <input type="text" class="form-control w-25 mb-3" name="art_title" id="artTitle" required>
                <input type="hidden" name="art_slug" id="artSlug">
            </div>
            <div class="form-group">
                
                <label for="art_cont">Contenu : </label>
                <textarea name="art_cont" cols="30" rows="5" class="form-control w-50" required></textarea>
            </div>
                
                <button type="submit" class="btn btn-primary mt-2">Envoyer</button>

            </form>
        <?php
        
        if(isset($_SESSION["artAdded"]) && $_SESSION["artAdded"] === true) {
            include("inc/artadded.php");
            $_SESSION["artAdded"] = false;
        }
        ?>
</div>
<?php
            include("inc/footer.php");
        ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../public/scripts/addArt.script.js"></script>
</body>
</html>