<?php
    if (!isset($_SESSION["level"]) || $_SESSION["level"] < 7) {
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
        ?>
        <p class="h1 mt-5">Control Utilisateurs</p>
            <p class="h3">Voici une liste de tous les utilisateurs actuels et leurs statuts</p>
            <ul class="list-group d-flex flex-column align-items-center">
                <?php
                foreach($getUse AS $user) {
                    if ($user["lvl"] < 8) {
                    ?>
                    <form action="" method="POST">
                        <li class="list-group-item w-25 bg-transparent border-0">
                        <div class="col d-flex flex-row">
                        <?=$user["nom"]?>
                        <span class="ms-3 badge badge-pill bg-primary">
                            <?=$user["lvl"]?>
                        </span>
                        <input type="hidden" name="id" value="<?=$user["id"]?>">
                        <?php
                            if($user["lvl"] < 7) {
                        ?>
                        <button class="bg-transparent border-0" type="submit" name="userUp" ><img src="../public/images/arrow-up.svg" alt="arrow up"></button>
                        <?php
                            }
                        ?>
                        <?php
                            if($user["lvl"] > 0) {
                        ?>
                        <button class="bg-transparent border-0" type="submit" name="userDown" ><img src="../public/images/arrow-down.svg" alt="arrow down"></button>
                        <?php
                            }
                        ?>
                        <button class="bg-danger border-0" type="submit" name="userDelete" ><img src="../public/images/x.svg" alt="x button"></button>
                    </div>
                </li>
                        </form>
                        <?php
                        }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php
var_dump($_SESSION["log"]);
            include("inc/footer.php");
        ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<!-- 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
    </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
    </svg>

-->