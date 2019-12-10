<?php

	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('model', 'ModelUser.php')));
	require_once (File::build_path(array('model', 'ModelCommand.php')));
	require_once (File::build_path(array('lib', 'Security.php')));
	require_once (File::build_path(array('lib', 'Session.php')));
	require_once (File::build_path(array('lib', 'ImageUploader.php')));
	require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerItem {

	protected static $object = "item";

	public static function read() {
		$id = htmlspecialchars(myGet('id'));
		$item = ModelItem::select($id);
		if ($item == false) {
			self::error();
		} else {
            $view='detail';
			$pagetitle='Detail item';
            require_once (File::build_path(array("view", "view.php")));
		}
	}

	public static function readAll() {
		if (Session::is_admin()) {
        $tab_item = ModelItem::selectAll();
        $view='list';
        $pagetitle='Item list';
		require (File::build_path(array("view", "view.php")));
		} else {
			static::$object = "user";
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

	public static function create() {
		if (Session::is_connected()) {
			if (Session::is_admin()) {
				if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
				$id = NULL;
				$name = "";
				$price = "";
				$description = "";
				$category = "";
				$levelaccess = "";
				$required = "required";
				$action = "created";
				$tab_category = ModelCategory::selectAll();
				$view='update';
				$pagetitle='Create Item';
				require_once (File::build_path(array("view", "view.php")));
			} else {
				static::$object = "home";
				echo "ALERTE : Vous devez être admin pour créer un objet";
				$view='marketplace';
				$pagetitle='home';
				require (File::build_path(array("view", "view.php")));
			}
		} else {
			static::$object = "user";
			Messenger::alert("ALERTE : Vous devez être connecté et administrateur pour créer un objet");
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

	public static function created() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (is_null(myGet('name')) || is_null(myGet('price')) || is_null(myGet('description')) || is_null(myGet('category')) || is_null(myGet('levelaccess'))) {
			$errorMessage = 'Some of the attribut are NULL';
		} else if (!Session::is_admin()) {
			$errorMessage = 'Cant access this page';
		}
		if(!isset($errorMessage)) {
			if (myGet('catalog') !== NULL) {$catalog = 1;} else { $catalog = 0;}
			$data = array (
				'id' => Security::generateRandomHex(),
				'name' => myGet('name'),
				'price' => myGet('price'),
				'description' => myGet('description'),
				'catalog' => $catalog,
				'nbbuy' => 0,
				'dateadd' => date("Y-m-d"),
				'category' => myGet('category'),
				'nbbuy' =>  0,
				'levelaccess' => myGet('levelaccess'),
			);
			$item = new ModelItem($data);
			if(!empty($_FILES['img']['name'])) { ImageUploader::uploadImg();}
			$item->save($data);
			$tab_item = ModelItem::selectAll();
			$view='created';
			$pagetitle='Item Created';
			require (File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert($errorMessage);
			static::$object = "user";
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

	public static function delete() {
		$id = myGet('id');
		if (Session::is_connected() && Session::is_admin()) {
			$view='delete';
			$pagetitle='Delete validation';
			require (File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert('You are not allowed to do such action');
			self::connect();
		}
	}

	public static function confirmDelete() {
		if (!Session::is_admin()) {
			$errorMessage = 'Cant access this page';
		}
		if (!isset($errorMessage)) {
			$id = myGet('id');
			$item = ModelItem::select($id);
			$name = $item->get('name');
			ModelItem::deleteById($id);
			$tab_item = ModelItem::selectAll();
			$view='deleted';
			$pagetitle='Delete Item';
			require_once (File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert($errorMessage);
			static::$object = "user";
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}

	}

	public static function update() {
		if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
		$item = ModelItem::select(myGet('id'));
		if($item->get('catalog') == 0) { $checked = NULL; } else { $checked = 'checked="checked"';}
		$id = htmlspecialchars($item->get('id'));
		$name = htmlspecialchars($item->get('name'));
		$price = htmlspecialchars($item->get('price'));
		$levelaccess = htmlspecialchars($item->get('levelaccess'));
		$description = htmlspecialchars($item->get('description'));
		$lastCat = htmlspecialchars($item->get('category'));
		$tab_category = ModelCategory::selectAll();
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function updated() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (is_null(myGet('name')) || is_null(myGet('price')) || is_null(myGet('description')) || is_null(myGet('category')) || is_null(myGet('levelaccess'))) {
			$errorMessage = 'Some of the attribut are NULL';
		} else if (!Session::is_admin()) {
			$errorMessage = 'Cant access this page';
		}
		if(!isset($errorMessage)) {
			if (myGet('catalog') !== NULL && myGet('catalog') == 'on') { $catalog = 1; } else { $catalog = 0; }
			$data = array (
				'id' => myGet('id'),
				'name' => myGet('name'),
				'description' => myGet('description'),
				'price' => myGet('price'),
				'category' => myGet('category'),
				'catalog' => $catalog,
				'levelaccess' => myGet('levelaccess'),
			);
			if(!empty($_FILES['img']['name'])) { ImageUploader::uploadImg();}
			ModelItem::updateByID($data);
			$tab_item = ModelItem::selectAll();
			$view='updated';
			$pagetitle='Item updated';
			require (File::build_path(array("view", "view.php")));
		} else {
			Messenger::alert($errorMessage);
			static::$object = "user";
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}

	}

	public static function paging() {
		if (myGet('condition') !== NULL && myGet('condition') != "") {
			$nb_Id = ModelItem::countCatalogCategory(myGet('condition'));
		} else {
			$nb_Id = ModelItem::countCatalog(); // le nombre d'item qui ont 1 pour l'attribut catalog
		}
		$parPage = 5; // le nombre d'item que l'on veut afficher par page
		$nbPage = ceil($nb_Id / $parPage); // On calcule le nombre de page par division nbProduit / Produit par page
		if(myGet('currentpage') !== NULL && myGet('currentpage') > 0 && myGet('currentpage') <= $nbPage) {
			$currentPage = myGet('currentpage');
		} else {
			$currentPage = 1;
		}
		if (myGet('search') != NULL) {
			$tab_from_search = ModelItem::selectFromSearch($currentPage, $parPage, myGet('search'));
			if (! empty($tab_from_search)) {
				$tab_result = $tab_from_search;
				$searchResult = "We found some items !";
			} else {
				$tab_result = array();
				$searchResult = "There are no items that correspond to your search query";
			}
		} else {
			$searchResult = NULL;
			if (myGet('condition') !== NULL) {
				$tab_result = Modelitem::selectPageCategory($currentPage, $parPage, myGet('condition'));
			} else {
				$tab_result = ModelItem::selectPage($currentPage, $parPage);
			}
		}
		if (Session::is_connected()) {
			require_once (File::build_path(array('controller', 'ControllerUser.php')));
			$user = ModelUser::select($_SESSION['login']);
		}
		$i = 0;
		if (empty($tab_result)) {
			foreach($tab_result as $item) {
				if ((Session::is_connected() && $user->get('level') < $item->get('levelaccess')) || (!Session::is_connected() && $item->get('levelaccess') > 1)) {
					unset($tab_result[$i]);
				}
				$i++;
			}
		}
		$tab_category = ModelCategory::selectAll();
		$view='paging';
		$pagetitle='paging';
		require_once (File::build_path(array("view", "view.php")));
	}

    public static function error() {
        $view='error';
        $pagetitle='Page d\'erreur';
        require File::build_path(array('view','view.php'));
    }

}

?>
