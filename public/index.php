<?php

session_start();
if (!isset($_SESSION["name"])){
    $_SESSION['name'] = "Visitor";
}
require_once ("../config.php");
require_once ("../control/dbconnect.php");
require_once ("../model/crud.model.php");
require_once ("../control/router.control.php");


