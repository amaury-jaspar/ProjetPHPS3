<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once(File::build_path(array('model', 'ModelItem.php')));

class ModelBasket extends Model {

    public static function addToBasket($id_item) {
        $item = ModelItem::select($id_item);
        var_dump($item);
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
    }

    public static function deleteFromBasket() {
        $item = ModelItem::select(myGet('id'));
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
        ControllerBasket::actualizeSumBasket();
        $sumBasket = $_SESSION['sumBasket'];
        $tab_basket = unserialize($_COOKIE['basket']);
        foreach($tab_basket as $key => $value) {
            if ($value > 0) {
            $currentBasket[$key] = ModelItem::select($key);
            }
        }
        $view='DeletedFromBasket';
        $pagetitle='Removed from basket';
        require (File::build_path(array("view", "view.php")));
    }

    public static function actualizeSumBasket() {
        if (isset($_COOKIE['basket'])) {
            $tab_basket = unserialize($_COOKIE['basket']);
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

}

?>
