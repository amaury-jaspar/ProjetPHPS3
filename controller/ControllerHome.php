<?php



class ControllerHome {

	protected static $object = "home";

    public function buildFrontPage() {

        $view='frontpage';
        $pagetitle='frontpage';
        require (File::build_path(array("view", "view.php")));

//        require_once (File::build_path(array('lib', 'viewBuilder.php')));
//        echo '1';
//        viewBuilder::displayView('frontpage', 'frontpage');
    }

}

?>