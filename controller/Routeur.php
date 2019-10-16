<?php

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
} else {
    $controller = 'SI_ACCUEIL_NON_RENSEIGNE';
}

$controller_class = ucfirst("controller") . ucfirst($controller);

$array = array("controller", $controller_class);

require_once (File::build_path($array) . ".php");

if (isset($_GET['action'])) {

    $action = $_GET['action'];
    $class_methods = get_class_methods($controller_class);

    if (!in_array($action, $class_methods)) {
        $array = array("view", "view.php");
        // Corriger la ligne ci-dessous
        $controller=$controller;
        $view="error.php";
        $pagetitle="Erreur";
        require (File::build_path($array));
    }

  } else {
    $action = "NOTRE_PAGE_PAR_DEFAUT";
}

$controller_class::$action();

?>