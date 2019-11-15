<?php

    require_once (File::build_path(array('model', 'ModelAdministration.php')));
    require_once (File::build_path(array('lib', 'Session.php')));

    class ControllerAdministration {

        protected static $object = "administration";

        public static function dashboard() {

            if (Session::is_admin()) {
               $controller= static::$object;
                $view='dashboard';
                $pagetitle='Dashboard';
                require (File::build_path(array("view", "view.php")));
            } else {
              echo 'Désolée mais vous n\'êtes pas un admin, vous ne pouvez pas accéder à cette page';
            }

        }

    }

?>