<?php

	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('lib', 'Security.php')));
	require_once (File::build_path(array('lib', 'Session.php')));
	require_once (File::build_path(array('lib', 'ImageUploader.php')));

class ControllerItem {

	protected static $object = "item";

	public static function read() {
		$id = htmlspecialchars(Routeur::myGet('id'));
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
		if (Routeur::myGet('catalog') !== NULL) {$catalog = 1;} else { $catalog = 0;}
		$data = array (
			'id' => Security::generateRandomHex(),
			'name' => Routeur::myGet('name'),
			'price' => Routeur::myGet('price'),
			'description' => Routeur::myGet('description'),
			'catalog' => $catalog,
			'nbbuy' => 0,
			'dateadd' => date("Y-m-d"),
			'category' => Routeur::myGet('category')
		);
		$item = new ModelItem($data);
		var_dump($_FILES['img']);
		if(!empty($_FILES['img'])) { ImageUploader::uploadImg($_FILE['img']);}
		$item->save($data);
		$tab_item = ModelItem::selectAll();
		$view='created';
		$pagetitle='Item Created';
		require (File::build_path(array("view", "view.php")));
	}

	public static function delete() {
		$id = Routeur::myGet('id');
		ModelItem::deleteById($id);
		$tab_item = ModelItem::selectAll();
		$controller= static::$object;
		$view='deleted';
		$pagetitle='Delete Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function update() {
		$id = Routeur::myGet('id');
		$item = ModelItem::select($id);
		$name = $item->get('name');
		$price = $item->get('price');
		$description = $item->get('description');
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Item';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function updated() {
		$data = array (
			'id' => Routeur::myGet('id'),
			'name' => Routeur::myGet('name'),
			'description' => Routeur::myGet('description'),
			'price' => Routeur::myGet('price')
		);
		ModelItem::updateByID($data);
		$tab_item = ModelItem::selectAll();
		$view='updated';
		$pagetitle='Item updated';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function paging() {

		if (Routeur::myGet('condition') !== NULL && Routeur::myGet('condition') != "") {
			$nb_Id = Modelitem::countCatalogCategory(Routeur::myGet('condition'));
		} else {
			$nb_Id = ModelItem::countCatalog(); // le nombre d'item qui ont 1 pour l'attribut catalog
		}

		$parPage = 5; // le nombre d'item que l'on veut afficher par page
		$nbPage = ceil($nb_Id['nb_Id'] / $parPage); // On calcule le nombre de page par division nbProduit / Produit par page

		if( Routeur::myGet('currentpage') !== NULL && Routeur::myGet('currentpage') > 0 && Routeur::myGet('currentpage') <= $nbPage) {
			$currentPage = Routeur::myGet('currentpage');
		} else {
			$currentPage = 1;
		}

		if (Routeur::myGet('condition') !== NULL) {
			$tab_result = Modelitem::selectPageCategory($currentPage, $parPage, Routeur::myGet('condition'));    
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
			$sum += $item->get('price') * $value;
		}
		$_SESSION['sumBasket'] = $sum;
	}

	public static function readBasket() {
		ControllerItem::actualizeSumBasket();
		$sumBasket = $_SESSION['sumBasket'];
		$tab_basket = unserialize($_COOKIE['basket']);

		foreach($tab_basket as $key => $value) {
			if ($value > 0) {
			$currentBasket[$key] = ModelItem::select($key);
			}
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
		if(isset($tab_basket[Routeur::myGet('id')])) {
			$tab_basket[Routeur::myGet('id')] += 1;
		} else {
			$tab_basket[Routeur::myGet('id')] = 1;
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
		if(isset($tab_basket[Routeur::myGet('id')])) {
			$tab_basket[Routeur::myGet('id')] -= 1;
			if($tab_basket[Routeur::myGet('id')] == 0 ) {
				if (isset($_GET['id'])) { unset($_GET['id']);}
				if (isset($_POST['id'])) { unset($_POST['id']);}
			}
		}
		setcookie('basket', serialize($tab_basket), time() + (60 * 60 * 24));
		ControllerItem::actualizeSumBasket();

		// code de readFromBasket
/*		$sumBasket = $_SESSION['sumBasket'];
		$tab_basket = unserialize($_COOKIE['basket']);
		foreach($tab_basket as $key => $value) {
			if ($value > 0) {
			$currentBasket[$key] = ModelItem::select($key);
			}
		}
*/
		ControllerItem::readBasket();

//		$view='basket';
//		$pagetitle='Basket';
//		require (File::build_path(array("view", "view.php")));
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