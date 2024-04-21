<?php

if(isset($_GET['json'])){
    $datas = getMapMarkers($db);
    if(!is_string($datas)){
        echo json_encode($datas);
    }
    exit();
}
$datas = getMapMarkers($db); 