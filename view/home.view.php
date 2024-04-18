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
    <div class="container mt-2 d-flex flex-column align-items-center">
        <div class="row">
            <div class="col text-center">
        <?php
        if (isset($errorMessage)) : echo $errorMessage; endif;
        include("inc/header.php");
        ?>
                <p class="h1 mt-5">Bienvenue dans ma nouvelle expérience CRUD et Bootstrap<p>
                <p class="h3">Connectez-vous pour continuer</p>
                <p class="h5">ou cliquez <a href="?p=read">ici</a> pour lire les articles</p>
            </div>    
            <?php
            if(!isset($_SESSION['monID']) || 
            $_SESSION['monID']!== session_id())
            {
                echo $_SESSION["name"];
                include("inc/login.php");
            }
            ?>

        <?php
            include("inc/footer.php");
        ?>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>