<?php

require_once (File::build_path(array('model', 'ModelInventory.php')));

class ControllerInventory {

    protected static $object = 'inventory';        

    public static function read() {
        $login_user = $_SESSION['login'];
        $tab_item = ModelInventory::selectItems('login', $login_user);
        $view = 'list';
        $pagetitle = 'Inventory';
        require(File::build_path(array('view','view.php')));
    }

    public static function addItem() {
        $login_user = $_SESSION['login'];
        $item_id = Routeur::myGet('id_item');
        $inventory = new ModelInventory($login_user, $item_id);
        $inventory->save($item_id);
        $view = 'addedToInventory';
        $pagetitle = 'Item added to Inventory';
        require (File::build_path(array("view","view.php")));
    }

}

?>