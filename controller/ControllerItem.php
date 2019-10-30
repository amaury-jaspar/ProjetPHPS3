<?php
require_once File::build_path(array('model','ModelItem.php'));

class ControllerItem {

	protected static $object = "item";

	public static function read() {
		$id = $_GET["id"];
		$item = ModelItem::getItemByID($id);
		if ($item == false) {
			ControllerItem::error();
		} else {
			$controller='item';
			$view='detail';
			$pagetitle= $item->getName();
			require File::build_path(array('view','view.php'));
		}
	}

	public static function readAll() {
		$tab_item = ModelItem::getAllItems();
		$controller='item';
		$view='list';
		$pagetitle='All Items';
		require File::build_path(array('view','view.php'));
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

	public static function error() {
		$controller='item';
		$view='error';
		$pagetitle='Error';
		require File::build_path(array('view','view.php'));
	}
}

?>