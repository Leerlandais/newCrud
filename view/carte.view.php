<?php
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
        <link rel="stylesheet" href="../public/styles/style.css">
        <title><?=$title?></title>
    </head>
    <body>
        <div class="container mt-2 h-auto">
            <?php
            include("inc/header.php");
            ?>
            <div class="row">
                <div class="col text-center">
                    <p class="h1 mt-5">J'ai décidé d'inclure une carte</p>
                    <p class="h3">Cliquez sur un nom d'utilisateur pour voir son emplacement préféré</p>
                    <p class="h4 text-warning">&lpar;Prochaine étape : Clusters&rpar;</p>
                    <a href="?json" target="_blank">API</a> format JSON
                    <p id="message"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <ul class="list-group">
                        <?php
                                foreach($mapMarkers as $mark) {
                                    ?>
                                <a href="?p=carte&lat=<?=$mark["map_lat"]?>&long=<?=$mark["map_long"]?>" class="markerHop link-underline link-underline-opacity-0"><li class="list-group-item border-0 bg-transparent fst-italic"><?=$mark["map_name"]?></li></a>
                                
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
           
                    <div id="mapCard" class="col-8"></div>
                    <div class="col-2">
                        <?php
                        foreach($getUse as $use) {
                            if ($use["mark"] === 0 && $use["nom"] === $_SESSION["name"]) {
                                ?>
                                <p><span class="text-danger fst-italic"><?=$_SESSION["name"]?></span>, vous n'avez pas encore ajouté de marqueur de carte. Entrez la latitude et la longitude ici pour en ajouter une</p>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="map_name">Nom de Marqueur : </label>
                                        <input type="text" class="form-control w-100 mb-3" name="map_name" id="mapName" required>
                                        <label for="map_lat">Latitude : </label>
                                        <input type="number" step="0.00001" class="form-control w-100 mb-3" name="map_lat" id="mapLat" required>
                                        <label for="map_lat">Longitude : </label>
                                        <input type="number" step="0.00001" class="form-control w-100 mb-3" name="map_lon" id="mapLon" required>
                                        <button type="submit" class="btn btn-primary mt-2">Ajouter</button>
                                        
                                    </div>                                
                                    <?php
                            }else if ($use["mark"] === 1 && $use["nom"] === $_SESSION["name"]) {
                                ?>
                                <p><span class="text-danger fst-italic"><?=$_SESSION["name"]?></span>, vous disposez déjà d'un marqueur de carte mais vous pouvez modifier sa position et nom ici</p>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="map_name">Nom de Marqueur : </label>
                                        <input type="text" class="form-control w-100 mb-3" name="map_name_new" id="mapNameNew"  required>
                                        <label for="map_lat">Latitude : </label>
                                        <input type="number" step="0.00001" class="form-control w-100 mb-3" name="map_lat_new" id="mapLatNew" required>
                                        <label for="map_lat">Longitude : </label>
                                        <input type="number" step="0.00001" class="form-control w-100 mb-3" name="map_lon_new" id="mapLonNew" required>
                                        <button type="submit" class="btn btn-primary mt-2">Mettez-le à jour</button>
                                        
                                    </div>  
                                <?php
                            }
                        }
                    ?>
                          
                        </div>
                    </div>
            </div>
        </div>
        <?php
            include("inc/footer.php");
            ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
     <script src="../public/scripts/map.script.js"></script>
    </body>
    </html>