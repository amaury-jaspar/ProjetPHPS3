<?php
require_once (File::build_path(array('model', 'ModelUser.php')));
require_once (File::build_path(array('lib', 'Security.php')));
class ControllerItem extends Controller {

	protected static $item;

	public static function read() {
		$id = htmlspecialchars($_GET['id']);
		$item = ModelItem::select($id);
		if ($item == false) {
			Controller::displayView('error', 'Page d\'erreur');
		} else {
			Controller::displayView("detail", "Item details");
		}
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