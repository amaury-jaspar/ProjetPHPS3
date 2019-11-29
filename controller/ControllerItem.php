<?php

	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('model', 'ModelUser.php')));
	require_once (File::build_path(array('model', 'ModelInventory.php')));
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
        $tab_item = ModelItem::selectAll();
        $view='list';
        $pagetitle='Item list';
        require (File::build_path(array("view", "view.php")));
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
			echo "ALERTE : Vous devez être connecté et administrateur pour créer un objet";
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

	public static function created() {
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
		if(!empty($_FILES['img'])) { ImageUploader::uploadImg();}
		$item->save($data);
		$tab_item = ModelItem::selectAll();
		$view='created';
		$pagetitle='Item Created';
		require (File::build_path(array("view", "view.php")));
	}

	public static function delete() {
		$id = myGet('id');
		ModelItem::deleteById($id);
		$tab_item = ModelItem::selectAll();
		$view='deleted';
		$pagetitle='Delete Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function update() {
		if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
		$id = myGet('id');
		$item = ModelItem::select($id);
		if($item->get('catalog') == 1) { $checked = 'checked="checked"'; } else { $checked = NULL;}
		$name = $item->get('name');
		$price = $item->get('price');
		$levelaccess = $item->get('levelaccess');
		$description = $item->get('description');
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function updated() {
		if (myGet('levelaccess') !== NULL && myGet('levelaccess') == on) { $catalog = 1; } else { $catalog = 0; }
		$data = array (
			'id' => myGet('id'),
			'name' => myGet('name'),
			'description' => myGet('description'),
			'price' => myGet('price'),
			'catalog' => $catalog,
			'levelaccess' => myGet('levelaccess'),
		);
		ModelItem::updateByID($data);
		if(!empty($_FILES['img'])) { ImageUploader::uploadImg();}
		$tab_item = ModelItem::selectAll();
		$view='updated';
		$pagetitle='Item updated';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function paging() {

		if (myGet('condition') !== NULL && myGet('condition') != "") {
			$nb_Id = Modelitem::countCatalogCategory(myGet('condition'));
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

		if (myGet('condition') !== NULL) {
			$tab_result = Modelitem::selectPageCategory($currentPage, $parPage, myGet('condition'));
		} else {
			$tab_result = ModelItem::selectPage($currentPage, $parPage);
		}

		if (Session::is_connected()) {
			require_once (File::build_path(array('controller', 'ControllerUser.php')));
			$user = ModelUser::select($_SESSION['login']);
		}

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
