<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once (File::build_path(array('model', 'ModelItem.php')));

class ModelBasket extends Model {

    public static function getBasketFromCookie() {
        if (isset($_COOKIE['basket'])) {
            return unserialize($_COOKIE['basket']);
        } else {
            return $tab_basket;
        }
    }

    public static function getBasketFromSession() {
        if (isset($_SESSION['basket'])) {
            return $_SESSION['basket'];
        } else {
            return $tab_basket;
        }        
    }

    public static function buildBasketFromCookie() {
        $tab_basket = self::getBasketFromCookie();
        $currentBasket = array();
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
                    $currentBasket[] = ModelItem::select($key);
            }
        }
        return $currentBasket;
    }

    public static function buildBasketFromSession() {
        $tab_basket = self::getBasketFromSession();
        $currentBasket = array();
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
                    $currentBasket[$i] = ModelItem::select($key);
            }
        }
        return $currentBasket;
    }

    public static function getSumBasket() {
        self::actualizeSumBasket();
        return $_SESSION['sumBasket'];
    }

    public static function actualizeSumBasket() {
        $sum = 0;
        $tab_basket = self::getBasketFromCookie();
            foreach($tab_basket as $key => $value) {
                $item = ModelItem::select($key);
                $sum += $item->get('price') * $value;
            }
        $_SESSION['sumBasket'] = $sum;
    }

    public static function addToBasket($id) {
        $item = ModelItem::select($id);
        $tab_basket = self::getBasketFromCookie();
         if ($tab_basket !== NULL) {
            if(isset($tab_basket[$id])) {
                $tab_basket[$id] += 1;
            } else {
                $tab_basket[$id] = 1;
            }
        }
        self::setBasket($tab_basket);
        ModelBasket::actualizeSumBasket();
        return $item;
    }

    public static function deleteFromBasket($id) {
        $item = ModelItem::select($id);
        $tab_basket = self::getBasketFromCookie();
        if ($tab_basket !== NULL) {
            if(isset($tab_basket[$id])) {
                $tab_basket[$id] -= 1;
                if($tab_basket[$id] <= 0) {
                    unset($tab_basket[$id]);
                }
            }
        }
        self::setBasket($tab_basket);
        self::actualizeSumBasket();
        return $item;
    }

    public static function setBasket($tab_basket) {
        $_SESSION['basket'] = $tab_basket;
        setcookie('basket', serialize($tab_basket), time() + (60 * 60 * 24));
        self::actualizeSumBasket();
    }

    public static function resetBasket() {
        $tab_basket = NULL;
        setcookie('basket', "", time() - 1);
        unset($_SESSION['basket']);
        unset($_SESSION['sumBasket']);
     }

    public static function buyBasket() {
//        ModelCommand::buyBasket();
    }

}

?>
