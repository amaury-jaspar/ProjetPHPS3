<?php

require_once (File::build_path(array('model', 'ModelCommand.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerCommand {

	protected static $object = "command";

	public static function read() {
		$id = htmlspecialchars(myGet('id_command'));
		$command = ModelCommand::select($id);
		if ($command == false) {
			self::error();
		} else {
            $view='detail';
			$pagetitle='Detail command';
            require_once (File::build_path(array("view", "view.php")));
		}
	}

	public static function readAll() {
			$login_user = $_SESSION['login'];
		  $data = array(
		    "login_user" => $login_user
		  );
		  $tab_commands = ModelCommand::selectWhereFromArray($data);
		  if (!empty($tab_commands)) {
		    $tab_items = array();
		    foreach ($items as $tuple) {
		      $current_item = ModelItem::select($tuple['item_id']);
		      $tab_items[] = $current_item;
	    }
	  }
	  $view='list';
	  $pagetitle='Command list';
	  require (File::build_path(array("view", "view.php")));
	}

	public static function create($data) {
		$command = new ModelItem($data);
        $command->save($data);
  }

	public static function delete() {
		$id = myGet('id_command');
		ModelCommand::deleteById($id);
		$tab_command = ModelCommand::selectAll();
		$view='deleted';
		$pagetitle='Delete Command';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function error() {
		$view='error';
		$pagetitle='Page d\'erreur';
		require File::build_path(array('view','view.php'));
	}
}

?>
