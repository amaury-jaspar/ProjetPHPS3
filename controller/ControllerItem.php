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
			$view='error';
            $pagetitle='Error page';
			require_once (File::build_path(array("view", "view.php")));
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
		$id = NULL;
		$name = "";
		$price = "";
		$description = "";
		$category = "";
		$required = "required";
		$action = "created";
		$view='update';
		$pagetitle='Create Item';
		require_once (File::build_path(array("view", "view.php")));
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
		$view='created';
		$pagetitle='Item Created';
		require (File::build_path(array("view", "view.php")));
	}

	public static function delete() {
		$id = $_GET['id'];
		ModelItem::deleteById($id);
		$tab_item = ModelItem::selectAll();
		$controller= static::$object;
		$view='deleted';
		$pagetitle='Delete Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function update() {
		$id = $_GET['id'];
		$item = ModelItem::select($id);
		$name = $item->getName();
		$price = $item->getPrice();
		$description = $item->getDescription();
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Item';
		require_once (File::build_path(array("view", "view.php")));
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
		$view='updated';
		$pagetitle='Item updated';
		require_once (File::build_path(array("view", "view.php")));
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

		$view='paging';
		$pagetitle='paging';
		require_once (File::build_path(array("view", "view.php")));

	}

	public function marketplace () {
		$tab_category = array(
			"alchimist" => "Welcome to the Alchimist", 
			"tavern"  => "Welcome to the Tavern",
			"bookstore" => "Welcome to the Bookstore",
			"temple" => "Welcome to the Temple",
			"armory" => "Welcome to the Armory"
		);
		$view='marketplace';
		$pagetitle='Item updated';
		require_once (File::build_path(array("view", "view.php")));
	}

//-----------------------------------BASKET--------------------------------------------------------------------------------------

/*
*	Fonctionnement du panier :
*		$_COOKIE['basket'] : tableau de type key => value
*			pour stocker dans key les ID des produits dans le panier
*			et dans value la quantitée de ce produit placé dans ce panier
*		$_SESSION['sumBasket'] sert à stocker la valeur totale du panier
*			pour stocker la somme des produits du panier
*			à actualiser le plus souvent possible grâce à la fonction actualiserSommePanier
*/

	public static function actualizeSumBasket() {
		$tab_item = unserialize($_COOKIE['basket']);
		$sum = 0;
		foreach($tab_item as $key => $value) {
			$item = ModelItem::select($key);
			$sum += $item->getPrice() * $value;
		}
		$_SESSION['sumBasket'] = $sum;
	}

	public static function readBasket() {
		ControllerItem::actualizeSumBasket();
		$sumBasket = $_SESSION['sumBasket'];
		$tab_basket = unserialize($_COOKIE['basket']);

		foreach($tab_basket as $key => $value) {
			$currentBasket[$key] = ModelItem::select($key);
		}

		$view='basket';
		$pagetitle='Basket';
		require (File::build_path(array("view", "view.php")));
	}

	public static function addToBasket() {
		if(isset($_COOKIE['basket'])) {
			$tab_basket = unserialize($_COOKIE['basket']);
		} else {
			$tab_basket;
		}
		if(isset($tab_basket[$_GET['id']])) {
			$tab_basket[$_GET['id']] += 1;
		} else {
			$tab_basket[$_GET['id']] = 1;
		}
		setcookie('basket', serialize($tab_basket), time()+ (60 * 60 * 24));
		ControllerItem::actualizeSumBasket();
		$view='addedToBasket';
		$pagetitle='The item have been add to the basket succesfully';
		require (File::build_path(array("view", "view.php")));
	}

	public static function resetBasket() {
		$tab_basket = NULL;
		setcookie('basket', "", time() - 1);
		$_SESSION['sumBasket'] = 0;
		echo "Your basket is now empty";
		$view='panier';
		$pagetitle='Panier';
		require (File::build_path(array("view", "view.php")));
	}

	public static function deleteFromBasket() {
		if(isset($_COOKIE['basket'])) {
			$tab_basket = unserialize($_COOKIE['basket']);
		} else {
			$view='error';
			$pagetitle='Error';
			require (File::build_path(array("view", "view.php")));
		}
		if(isset($tab_basket[$_GET['id']])) {
			$tab_basket[$_GET['id']] -= 1;
			if($tab_basket[$_GET['id']] == 0 ) {
				unset($_GET['id']);
			}
		}
		setcookie('basket', serialize($tab_basket), time()+ (60 * 60 * 24));
		ControllerItem::actualizeSumBasket();
		$view='basket';
		$pagetitle='Basket';
		require (File::build_path(array("view", "view.php")));
	}





//-------------------------------------------------------------------------------------------------------------------------


}

?>