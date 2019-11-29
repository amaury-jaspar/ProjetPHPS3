<?php

require_once File::build_path(array('controller',"ControllerBasket.php"));
require_once File::build_path(array('controller',"ControllerAdministration.php"));
require_once File::build_path(array('controller',"ControllerCategory.php"));
require_once File::build_path(array('controller',"ControllerCommand.php"));
require_once File::build_path(array('controller',"ControllerHome.php"));
require_once File::build_path(array('controller',"ControllerInventory.php"));
require_once File::build_path(array('controller',"ControllerItem.php"));
require_once File::build_path(array('controller',"ControllerTest.php"));
require_once File::build_path(array('controller',"ControllerUser.php"));
require_once File::build_path(array('controller',"ControllerWishlist.php"));

/*
if (Routeur::myGet('message') !== NULL) {
    echo "<script type=\"text/javascript\">window.alert('You must enter your full name.');
    window.location.href = '/index.html';</script>";
    exit;
}
*/

function alert($a){
echo "<script>alert('$a')</script>";
}

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
    $controller_class = 'Controller' . Routeur::myGet('controller');
} else {
    $controller_class =  'ControllerHome';
}

$array = array("controller", $controller_class);

if (class_exists($controller_class)) {
    $class_methods = get_class_methods($controller_class);
    if (Routeur::myGet('action') !== NULL) {
        $action = Routeur::myGet('action');
        if (in_array($action, $class_methods)) {
            $controller_class::$action();
        } else {
            ControllerUser::error();
        }
    } else {
        ControllerHome::buildFrontPage();
    }
} else {
    ControllerHome::buildFrontPage();
}



?>