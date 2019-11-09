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
		$id = NULL;
		$name = "";
		$price = "";
		$description = "";
		$category = "";
		$required = "required";
		$action = "created";
		$array = array("view", "view.php");
		$view='update';
		$pagetitle='Create Item';
		require_once (File::build_path($array));
	}

	public static function created() {
		$item = new ModelItem($_GET['name'], $_GET['price'], $_GET['description'], "bookstore");
		if (isset($_GET['catalog'])) {$catalog = 1;} else { $catalog = 0;}
		$data = array (
			'id' => $item->getId(),
			'name' => $item->getName(),
			'price' => $item->getPrice(),
			'description' => $item->getDescription(),
			'catalog' => $catalog,
			'nbbuy' => 0,
			'dateadd' => date("Y-m-d"),
			'category' => "bookstore"
		);
		$item->save($data);
		$tab_item = ModelItem::selectAll();
		$array = array("view", "view.php");
		$view='created';
		$pagetitle='Item Created';
		require (File::build_path($array));
	}

	public static function delete() {
		$id = $_GET['id'];
		ModelItem::deleteById($id);
		$tab_item = ModelItem::selectAll();
		$array = array("view", "view.php");
		$controller= static::$object;
		$array = array("view", "view.php");
		$view='deleted';
		$pagetitle='Delete Item';
		require_once (File::build_path($array));
	}

	public static function update() {
		$id = $_GET['id'];
		$item = ModelItem::select($id);
		$name = $item->getName();
		$price = $item->getPrice();
		$description = $item->getDescription();
		$required = "readonly";
		$action = "updated";
		$array = array("view", "view.php");
		$view='update';
		$pagetitle='Update Item';
		require_once (File::build_path($array));
	}

	public static function updated() {
		$data = array (
			'id' => $_GET['id'],
			'name' => $_GET['name'],
			'description' => $_GET['description'],
			'price' => $_GET['price']
		);
		ModelItem::updateByID($data);
		$tab_item = ModelItem::selectAll();
		$array = array("view", "view.php");
		$view='updated';
		$pagetitle='Item updated';
		require_once (File::build_path($array));
	}

	public static function paging() {

		if (isset($_GET['condition']) && $_GET['condition'] != "") {
			$nb_Id = Modelitem::countCatalogCategory($_GET['condition']);
		} else {
			$nb_Id = ModelItem::countCatalog(); // le nombre d'item qui ont 1 pour l'attribut catalog
		}

		$parPage = 5; // le nombre d'item que l'on veut afficher par page
		$nbPage = ceil($nb_Id['nb_Id'] / $parPage); // On calcule le nombre de page par division nbProduit / Produit par page

		if(isset($_GET['currentpage']) && $_GET['currentpage'] > 0 && $_GET['currentpage'] <= $nbPage) {
			$currentPage = $_GET['currentpage'];
		} else {
			$currentPage = 1;
		}

		if (isset($_GET['condition'])) {
			$tab_result = Modelitem::selectPageCategory($currentPage, $parPage, $_GET['condition']);    
		} else {
			$tab_result = ModelItem::selectPage($currentPage, $parPage);
		}

		$array = array("view", "view.php");
		$view='paging';
		$pagetitle='paging';
		require_once (File::build_path($array));

	}

}

?>