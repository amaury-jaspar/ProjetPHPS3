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


// si is_connected est faux, alors on lit le panier côté cookie, sinon on lit le panier côté serveur
public static function readBasket() {
    if (isset($_SESSION['sumBasket'])) {
        $sumBasket = $_SESSION['sumBasket'];
    } else {
        $sumBasket = 0;
    }
    $currentBasket = array();
    if (isset($_COOKIE['basket'])) {
        $tab_basket = unserialize($_COOKIE['basket']);
        ControllerBasket::actualizeSumBasket();
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
                $currentBasket[$key] = ModelItem::select($key);
            }
        }
        $ButtonState = null;
    } else {
        $tab_basket = array();
        $ButtonState = "disabled";
    }

    $view='basket';
    $pagetitle='Basket';
    require (File::build_path(array("view", "view.php")));
}

public static function resetBasket() {
    $tab_basket = NULL;
    setcookie('basket', "", time() - 1);
    unset($_SESSION['basket']);
    $_SESSION['sumBasket'] = 0;
    $view='basketReseted';
    $pagetitle='Panier';
    require (File::build_path(array("view", "view.php")));
}

public static function beforeBuyBasket() {
    if (Session::is_connected()) {
        ControllerBasket::actualizeSumBasket();
        $sumBasket = $_SESSION['sumBasket'];
        $tab_basket = unserialize($_COOKIE['basket']);
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
                $currentBasket[$key] = ModelItem::select($key);
            }
        }
        require_once (File::build_path(array('controller', 'ControllerUser.php')));
        $user = ModelUser::select($_SESSION['login']);
        $moneyBefore = $user->get('wallet');
        $moneyAfter = $moneyBefore - $sumBasket;
        if ($moneyBefore >= $sumBasket) {
            $_SESSION['basket'] = $tab_basket;
            $view='checkBasket';
            $pagetitle='Basket';
            require (File::build_path(array("view", "view.php")));
        } else {
            static::$object = "user";
            Messenger::alert("ALERTE : You do not have any money");
            $view='profil';
            $pagetitle='profil';
            require (File::build_path(array("view", "view.php")));
        }
    } else {
        static::$object = "user";
        Messenger::alert("YOUR ATTENTION PLEASE : You need to be connected to buy the content of your basket");
        ControllerUser::connect();
    }
}

public static function addToBasket() {
    ModelBasket::addToBasket(myGet('id'));
    $view='addedToBasket';
    $pagetitle='The item have been add to the basket succesfully';
    require (File::build_path(array("view", "view.php")));
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
    if (Session::is_connected()) {
        if ($user->get('billingaddress') !== NULL && $user->get('shippingaddress')) {
        // On commence par récupérer la somme du panier qui est dans la session
        $sumBasket = $_SESSION['sumBasket']; // On récupère la somme du panier
        // On instancie un utilisateur afin de pouvoir lui soustraite le montant du panier et d'augmenter son attribut spend
        if ($user->get('wallet') >= $sumBasket) {
            $user->set('wallet', $user->get('wallet') - $sumBasket);
            $user->set('spend', $user->get('spend') + $sumBasket);
            $newLevel = $user->get('spend') / 100;
            if ($newLevel != $user->get('level')) {
                echo 'Bravo, vous passez du  niveau '.$user->get('level'). ' au niveau ' .$newLevel;
                $user->set('level', $newLevel);
            }
            $data = array ('login' => $user->get('login'), 'wallet' => $user->get('wallet'), 'spend' => $user->get('spend'));
            ModelUser::updateByID($data);
            // Ensuite on enregistre la commande dans la table commande
            foreach($tab_basket as $key => $value) {
                $data = array (
                    'id_command' => NULL,
                    'login_user' => $user->get('login'),
                    'id_item' => $key,
                    'quantity_item' =>  $value,
                    'date_buy' => date("Y-m-d"),
                );
                ModelCommand::save($data);
            }
            // On finit en vidant le panier de la session, des cookies
            // Il faut en faire plus ici, car il existe plusieurs moyens de conserver des cookie
            unset($_COOKIE['basket']);
            setcookie('basket', "", time() - 1);
            unset($_SESSION['basket']); // on efface le panier dans la Session
            $_SESSION['sumBasket'] = 0;
            // Pour chaque item, il faut incrémenter l'attribut nbAchat
            foreach($tab_basket as $key => $value) {
                $item = ModelItem::select($key);
                $item->set('nbbuy', $item->get('nbbuy') + $value);
            }
            $view='bought';
            $pagetitle='Basket bought';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert("You do not have enought money, you should add money to your account first");
            static::$object = "user";
            $view='profil';
            $pagetitle='profile';
            require (File::build_path(array("view", "view.php")));
        }
        } else {
            static::$object = "user";
            Messenger::alert("YOUR ATTENTION PLEASE : You didn\'t told us about your billing and shipping address. Please, fill the form in profil -> detail -> update data"); #function call
            $view='profil';
            $pagetitle='profile';
            require (File::build_path(array("view", "view.php")));
        }
    } else {
        static::$object = "user";
        Messenger::alert("YOUR ATTENTION PLEASE : You need to be connected before be allowed to buy the content of your basket");
        ControllerUser::connect();
    }
}
}
