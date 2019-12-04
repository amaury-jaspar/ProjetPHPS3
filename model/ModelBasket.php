<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once (File::build_path(array('model', 'ModelItem.php')));

class ModelBasket extends Model {

    public static function getBasketFromCookie() {
        return unserialize($_COOKIE['basket']);
    }

    public static function getBasketFromSession() {
        return $_SESSION['basket'];
    }

    public static function buildBasket($tab_basket) {
        $currentBasket = array();
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
                $currentBasket[$key] = ModelItem::select($key);
            }
        }
        return $currentBasket;
    }

    public static function getSumBasket() {
        self::actualizeSumBasket();
        return $_SESSION['sumBasket'];
    }

    public static function setBasketInSession($tab_basket) {
        $_SESSION['basket'] = $tab_basket;
    }

    public static function setBasketInCookie($tab_basket) {
        $_SESSION['basket'] = serialize($tab_basket);
    }

    public static function actualizeSumBasket() {
        if (isset($_COOKIE['basket'])) {
            $tab_basket = self::getBasketFromCookie();
        } else {
            $tab_basket = array();
        }
        $sum = 0;
        foreach($tab_basket as $key => $value) {
            $item = ModelItem::select($key);
            $sum += $item->get('price') * $value;
        }
        $_SESSION['sumBasket'] = $sum;
    }

    public static function deleteFromBasket($item) {
        $item = ModelItem::select($item);
        if(isset($_COOKIE['basket'])) {
            $tab_basket = unserialize($_COOKIE['basket']);
        } else {
            self::error();
        }
        if(isset($tab_basket[$item->get('id')])) {
            $tab_basket[myGet('id')] -= 1;
            if($tab_basket[myGet('id')] <= 0) {
                unset($tab_basket[$item->get('id')]);
            }
        }
        setcookie('basket', serialize($tab_basket), time() + (60 * 60 * 24));
        self::actualizeSumBasket();
        return $item;
    }

    public static function addToBasket($id_item) {
        $item = ModelItem::select($id_item);
        $tab_basket = NULL;
        if(isset($_COOKIE['basket'])) {
            $tab_basket = unserialize($_COOKIE['basket']);
        }
        if(isset($tab_basket[$id_item])) {
            $tab_basket[$id_item] += 1;
        } else {
            $tab_basket[$id_item] = 1;
        }
        ModelBasket::actualizeSumBasket();
        setcookie('basket', serialize($tab_basket), time()+ (60 * 60 * 24));
        return $item;
    }

    public static function resetBasket() {
        $tab_basket = NULL;
        setcookie('basket', "", time() - 1);
        unset($_SESSION['basket']);
        self::actualizeSumBasket();
     }

    public static function buyBasket() {
        ModelCommand::buyBasket();

    }







    

    
}

?>
