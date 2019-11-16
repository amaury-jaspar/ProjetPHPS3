<?php

class ControllerHome {

	protected static $object = "home";

    public function buildFrontPage() {

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