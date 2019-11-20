<?php


// Une fonction qui va servir à convertir facilement le type de méthode que l'on souhaite dans les formulaire
// Passer de GET à POST facilement
class Routeur {

    public static function myGet($nomvar) {
        if (isset($_GET[$nomvar])) {
        return $_GET[$nomvar];
        } else if (isset($_POST[$nomvar])) {
            return $_POST[$nomvar];
        } else {
            return NULL;
        }
    }
}

if (Routeur::myGet('controller') !== NULL) { 
    $controller = Routeur::myGet('controller');
} else {
    $controller = 'home';
}

$controller_class = "Controller" . ucfirst($controller);

$array = array("controller", $controller_class);

require_once (File::build_path($array) . ".php");

if (Routeur::myGet('action') !== NULL) {

    $action = Routeur::myGet('action');
    $class_methods = get_class_methods($controller_class);

    if (!in_array($action, $class_methods)) {
        $array = array("view", "view.php");
        $view="error.php";
        $pagetitle="Erreur";
        require (File::build_path($array));
    }

  } else {
    $action = "buildFrontPage";
}

$controller_class::$action();

?>