<?php

session_start();
if (!isset($_SESSION["name"])){
    $_SESSION['name'] = "Visitor";
}
require_once ("../config.php");
require_once ("../control/dbconnect.php");
require_once ("../model/user.model.php");
require_once ("../model/article.model.php");
require_once ("../model/map.model.php");
require_once ("../control/json.control.php");
require_once ("../control/router.control.php");


