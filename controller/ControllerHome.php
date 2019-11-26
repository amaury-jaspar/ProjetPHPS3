<?php

require_once (File::build_path(array('lib', 'QueryBuilder.php')));

class ControllerHome {

	protected static $object = "home";

    public static function buildFrontPage() {
//        require_once (File::build_path(array('controller', 'ControllerCategory.php')));
//        $tab_category = ControllerCategory::selectAll();

        $tab_category = array(
            "alchimist" => "Welcome to the Alchimist", 
            "tavern"  => "Welcome to the Tavern",
            "bookstore" => "Welcome to the Bookstore",
            "temple" => "Welcome to the Temple",
            "armory" => "Welcome to the Armory"
        );

        $view='marketplace';
        $pagetitle='frontpage';
        require (File::build_path(array("view", "view.php")));
    }
}

?>