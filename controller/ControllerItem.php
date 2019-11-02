<?php

	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'viewBuilder.php')));

class ControllerItem {

	protected static $item;

	public static function read() {
		$id = htmlspecialchars($_GET['id']);
		$item = ModelItem::select($id);
		$array = array("view", "view.php");
		$view='detail';
		$pagetitle='Detail Item';
		require_once (File::build_path($array));
/*
		if ($item == false) {
			viewBuilder::displayView('error', 'Page d\'erreur');
		} else {
			viewBuilder::displayView("detail", "Item details");
		}
*/
	}

	public static function readAll() {

	}        

	public static function create() {

	}

	public static function created() {
	
	}

	public static function delete() {

	}

	public static function update() {
	
	}

	public static function updated() {

	}


}

?>