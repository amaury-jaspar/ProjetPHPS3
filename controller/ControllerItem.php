<?php

	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('lib', 'Security.php')));
	require_once (File::build_path(array('lib', 'Session.php')));

class ControllerItem {

	protected static $object = "item";

	public static function read() {
		$id = htmlspecialchars($_GET['id']);
		$item = ModelItem::select($id);
		if ($item == false) {
			$array = array("view", "view.php");
			$view='error';
            $pagetitle='Error page';
			require_once (File::build_path($array));
		} else {
            $array = array("view", "view.php");
            $view='detail';
			$pagetitle='Detail item';
            require_once (File::build_path($array));
		}
	}


	public static function readAll() {
        $tab_item = ModelItem::selectAll();
        $array = array("view", "view.php");
        $view='list';
        $pagetitle='Item list';
        require (File::build_path($array));
	}        

	public static function create() {
		$array = array("view", "view.php");
		$view='update';
		$pagetitle='Detail item';
		require_once (File::build_path($array));
	}

	public static function created() {
		$array = array("view", "view.php");
		$view='created';
		$pagetitle='Detail item';
		require_once (File::build_path($array));
	}

	public static function delete() {
		$array = array("view", "view.php");
		$view='delete';
		$pagetitle='Detail item';
		require_once (File::build_path($array));
	}

	public static function update() {
		$array = array("view", "view.php");
		$view='update';
		$pagetitle='Detail item';
		require_once (File::build_path($array));
	}

	public static function updated() {
		$array = array("view", "view.php");
		$view='updated';
		$pagetitle='Detail item';
		require_once (File::build_path($array));
	}


}

?>