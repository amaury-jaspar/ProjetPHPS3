<?php

class ControllerHome {

	protected static $object = "home";

    public function buildFrontPage() {
        $array = array("view", "view.php");
        $view='frontpage';
        $pagetitle='frontpage';
        require (File::build_path($array));
    }

}

?>