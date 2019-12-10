<?php

require_once (File::build_path(array('model', 'ModelCommand.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerCommand {

	protected static $object = "command";

	public static function read() {
		$id = htmlspecialchars(myGet('id'));
		$command = ModelCommand::select($id);
		$tab_items = $command->getItems();
		if ($command == false) {
			self::error();
		} else {
			if (Session::is_connected()) {
				if ($_SESSION['login']==$command->get('login_user') || Session::is_admin()) {
					$view='detail';
					$pagetitle='Detail command';
					require_once (File::build_path(array("view", "view.php")));
				} else {
					Messenger::alert('You are not allowed to do such action');
				}
			} else {
				static::$object="user";
				ControllerUser::connect();
			}
		}
	}

	public static function readAll() {
		if (Session::is_connected() && Session::is_admin()) {
			$tab_command = ModelCommand::selectAll();
			$view = 'list';
			$pagetitle = 'Command list';
			require(File::build_path(array("view", "view.php")));
		} else {
			ControllerHome::buildFrontPage();
		}
	}

	public static function readUserCommand() {
		if (Session::is_connected()) {
			$login_user = $_SESSION['login'];
			$data = array(
				"login_user" => $login_user
			);
			$tab_command = ModelCommand::selectWhereFromArray($data);
			if (!empty($wishlist)) {
				$tab_wishes = array();
				foreach ($wishlist as $tuple) {
					$current_item = ModelItem::select($tuple['item_id']);
					$tab_wishes[] = $current_item;
				}
			}
			$view='command';
			$pagetitle='Command list';
			require (File::build_path(array("view", "view.php")));
		} else {
			ControllerHome::buildFrontPage();
		}
	}

	public static function create() {
		if (Session::is_connected() && Session::is_admin()) {
			if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
			$login = "";
			$action = "created";
			$view = 'create';
			$pagetitle = 'Command creation';
			require(File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert('You are not allowed to do such action');
			static::$object="home";
			ControllerHome::buildFrontPage();
		}
	}

	public static function created() {
		$data = array (
			'login_user' => myGet('login')
		);
		$command = new ModelCommand($data);
		$command->save($data);
		$tab_command = ModelCommand::selectAll();
		$view='created';
		$pagetitle='Command created';
		require (File::build_path(array("view", "view.php")));
	}

	/*
	public static function update() {
		if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
		$command = ModelCommand::select(myGet('id'));
		$id_command = htmlspecialchars($command->get('id_command'));
		$login = htmlspecialchars($command->get('login_user'));
		$date_buy = htmlspecialchars($command->get('date_buy'));
		$action = "updated";
		$view='update';
		$pagetitle='Update command';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function updated() {
		$data = array (
			'id_command' => myGet('id_command'),
			'login_user' => myGet('login_user'),
			'date_buy' => myGet('date_buy'),
		);
		if(!empty($_FILES['img'])) { ImageUploader::uploadImg();}
		ModelCommand::updateByID($data);
		$tab_item = ModelItem::selectAll();
		$view='updated';
		$pagetitle='Item updated';
		require (File::build_path(array("view", "view.php")));
	}

	*/

	public static function delete() {
		$id = myGet('id');
		if (Session::is_connected() && Session::is_admin()) {
			$view='delete';
			$pagetitle='Delete validation';
			require (File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert('You are not allowed to do such action');
			ControllerUser::connect();
		}
	}

	public static function confirmDelete() {
		$id = myGet('id');
		ModelCommand::deleteById($id);
		$tab_command = ModelCommand::selectAll();
		$view='deleted';
		$pagetitle='Delete Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function error() {
		$view='error';
		$pagetitle='Page d\'erreur';
		require File::build_path(array('view','view.php'));
	}
}

?>
