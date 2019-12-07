<?php

    require_once (File::build_path(array('model', 'ModelBasket.php')));
	require_once (File::build_path(array('model', 'ModelItem.php')));
	require_once (File::build_path(array('model', 'ModelUser.php')));
	require_once (File::build_path(array('model', 'ModelInventory.php')));
	require_once (File::build_path(array('model', 'ModelCommand.php')));
    require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerBasket {

    protected static $object = "basket";

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

public static function readBasket() {
    $sumBasket = ModelBasket::getSumBasket();
    $tab_basket = ModelBasket::buildBasketFromCookie();
    if (!empty($tab_basket)) { $ButtonState = null; } else { $ButtonState = "disabled"; }
    $view='basket';
    $pagetitle='Basket';
    require (File::build_path(array("view", "view.php")));
}

// rajouter un second paramètre pour pouvoir rajouter x exemplaire d'un coup
public static function addToBasket() {
    $item = ModelBasket::addToBasket(myGet('id'));
    $view  ='addedToBasket';
    $pagetitle ='The item have been add to the basket succesfully';
    require (File::build_path(array("view", "view.php")));
}

public static function deleteFromBasket() {
    $item = ModelBasket::deleteFromBasket(myGet('id'));
    $view = 'DeletedFromBasket';
    $pagetitle = 'Removed from basket';
    require (File::build_path(array("view", "view.php")));
}

public static function transfertToWL() {
    $login = $_SESSION['login'];
    $item = ModelItem::select(myGet('id'));
    ModelWishList::add($login, $item);
    ControllerBasket::deleteFromBasket();
}

public static function resetBasket() {
    ModelBasket::resetBasket();
    $view ='basketReseted';
    $pagetitle ='Panier';
    require (File::build_path(array("view", "view.php")));
}

public static function beforeBuyBasket() {
    $user = ModelUser::select($_SESSION['login']);
    $moneyBefore = $user->get('wallet');
    $moneyAfter = $moneyBefore - $sumBasket;
    if (!Session::is_connected()) {
        $errorMessage = "You need to be connected to buy the content of your basket";
        $codeError = 1;
    } else if($moneyBefore < $sumBasket) {
        $errorMessage = "You do not have enough money";
        $codeError = 2;
    }
    if(!isset($errorMessage)) {
        ModelBasket::actualizeSumBasket();
        $tab_basket = ModelBasket::buildBasketFromSession();
        $_SESSION['basket'] = $tab_basket;
        $view ='checkBasket';
        $pagetitle ='Basket';
        require (File::build_path(array("view", "view.php")));
    } else if ($codeError == 2) {
        static::$object = "user";
        Messenger::alert($errorMessage);
        $view ='profil';
        $pagetitle ='profil';
        require (File::build_path(array("view", "view.php")));
    } else if ($codeError == 1) {
        static::$object = "user";
        Messenger::alert("");
        ControllerUser::connect();
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
    $user = ModelUser::select($_SESSION['login']);
    $sumBasket = ModelBasket::getSumBasket();
    if (isset($errorMessage)) { unset($errorMessage); }
    if (!Session::is_connected()) {
        $errorMessage = "You need to be connected to buy the content of your basket";
    } else if ($user->get('billingaddress') !== NULL || $user->get('shippingaddress')) {
        $errorMessage = "You didnt told us about your billing and shipping address. Please, fill the form in profil -> detail -> update data";
    } else if ($user->get('wallet') < $sumBasket) {
        $errorMessage = "You do not have enought money, you should add money to your account first";
    }
    if(!isset($errorMessage)) {
        // on soustrait l'argent du portemonnaie de l'acheteur
        $user->set('wallet', $user->get('wallet') - $sumBasket);
        // on actualise le champ qui recensse combien l'utilisateur à dépenser jusqu'à maintenant
        $user->set('spend', $user->get('spend') + $sumBasket);
        // s'il y a raison de, on modifie le niveau du joueur
        $newLevel = $user->get('spend') % 100;
        if ($newLevel != $user->get('level')) {
            $user->set('level', $newLevel);
            $message = "Bravo, vous passez du  niveau '.$user->get('level'). ' au niveau ' .$newLevel";
            Messenger::alert($message);
        }
        // puis on sauvegarde dans la BDD toutes les modification faites sur l'acheteur
        $data = array ('login' => $user->get('login'), 'wallet' => $user->get('wallet'), 'spend' => $user->get('spend'));
        ModelUser::updateByID($data);
        // Ensuite on enregistre la commande dans la table commande
        ModelBasket::buyBasket();
        ModeBasket::resetBasket();
        foreach($tab_basket as $key => $value) {
            $item = ModelItem::select($key);
            $item->set('nbbuy', $item->get('nbbuy') + $value);
            ModelItem::updateById($item);
        }
        $view='bought';
        $pagetitle='Basket bought';
        require (File::build_path(array("view", "view.php")));
    } else {
        Messenger::alert($errorMessage);
        static::$object = "user";
        $view='profil';
        $pagetitle='profile';
        require (File::build_path(array("view", "view.php")));
    }
}

}
