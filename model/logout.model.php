<?php

$json = json_encode($_SESSION);
$name = date("ymdHis").'.txt';
file_put_contents($name, $json);
// Détruit toutes les variables de session
$_SESSION = [];


// Si vous voulez détruire complètement la session,
// effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement
// les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy();

// redirection vers l'accueil
  
header("Location: ?p=home");
exit();
?>