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

//-----------------------------------BASKET--------------------------------------------------------------------------------------

/*
*	Fonctionnement du panier :
*		$_COOKIE['basket'] : tableau de type key => value
*			pour stocker dans key les ID des produits dans le panier
*			et dans value la quantité de ce produit placé dans ce panier
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

		// Envoie vers une page qui permet une dernière visualisation du panier avant de confirmer l'achat
		// Il faut faire quasiment comme readBasket, mais sans option de retirer ou quoi que ce soit
		// On confirme
		// Ou bien on demande à modifier, ce qui revient à appeler readBasket
	public static function beforeBuyBasket() {
		if (isset($_SESSION['login'])) {
			ControllerItem::actualizeSumBasket();
			$sumBasket = $_SESSION['sumBasket'];
			$tab_basket = unserialize($_COOKIE['basket']);
			require_once (File::build_path(array('controller', 'ControllerUser.php')));
			$user = ModelUser::select($_SESSION['login']);
			$moneyBefore = $user->get('wallet');
			$moneyAfter = $user->get('wallet') - $sumBasket;
			foreach($tab_basket as $key => $value) {
				$currentBasket[$key] = ModelItem::select($key);
			}
			$_SESSION['basket'] = $currentBasket;
			$view='checkBasket';
			$pagetitle='Basket';
			require (File::build_path(array("view", "view.php")));
		} else {
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

/* 1 - En premier lieu, l'utilisateur ne doit pas pouvoir acheter hors connexion
		On vérifie que l'utilisateur est connecté
			S'il ne l'est pas, on redirige vers la page de connexion
			s'il l'est, on continue.
 2 - On construit un utilisateur correspondant au Login de SESSION afin de pouvoir appeler ses attributs
 3 - On retire l'argent du porte-monnaie de l'utilisateur de la valeur dans depuis $_SESSION['sommePanier']
		IL faudrait vérifier que l'utilisateur a l'argent nécessaire
 4 - Pour chaque produit, on crée un exemplaire (avec ses spécificités) que l'on place dans la BDD avec la quantitée correspondante
		Un trigger doit faire le boulot d'ajouter le produit à son inventaire
 5 - On vide le panier, cookie et session
 6 - Puis on appelle une vue spéciale bougth.php, qui dit que l'achat a bien été réalisé
		Inviter à visiter l'inventaire, ou bien à faire autre chose
*/

	public static function confirmBuyBasket() {
		if (isset($_SESSION['login'])) {
			$sumBasket = $_SESSION['sumBasket'];
			require_once (File::build_path(array('controller', 'ControllerUser.php')));
			$user = ModelUser::select($_SESSION['login']);
			if ($user->get('wallet') >= $sumBasket) {
				$user->set('wallet', $user->get('wallet') - $sumBasket);
				$tab_basket = $_SESSION['basket'];
				unset($_SESSION['basket']);
/*				Si on ne fait pas de trigger dans la BDD
				foreach($tab_basket as $key => $value) {
					for($i = 0; $i < $value; $i++) {
						ControllerInventory::addToInventory($id, $user->getLogin());
					}
				}
*/
				echo '1';
				setcookie('basket', "", time() - 1);
				$_SESSION['sumBasket'] = 0;
				echo '2';
				$user->payBill($user->get('wallet') - $sumBasket);
				echo '3';
				$view='bought';
				$pagetitle='Basket bought';
				require (File::build_path(array("view", "view.php")));
			} else {
				echo "You do not have enought money, you should add money to your account first";
				$view='basket';
				$pagetitle='Basket';
				require (File::build_path(array("view", "view.php")));
			}
		} else {
			$view='connect';
			$pagetitle='connection';
			require (File::build_path(array("view", "view.php")));
		}
	}

//-------------------------------------------------------------------------------------------------------------------------


}

?>