<?php

require_once (File::build_path(array('model', 'ModelWishlist.php')));
require_once (File::build_path(array('lib', 'Session.php')));

class ControllerWishlist {

  protected static $object = 'wishlist';

  public static function read() {
    $login_user = $_SESSION['login'];
    $tab_item = ModelWishlist::selectWhere('login_user', $login_user);
    $view = 'list';
    $pagetitle = 'Wishlist';
    require(File::build_path(array('view','view.php')));
  }

  public static function addItem() {
    $login_user = $_SESSION['login'];
    $item_id = Routeur::myGet('item_id');
    $wishlist = new ModelWishlist($login_user, $item_id);
    $wishlist->save($item_id);
    $view = 'addedToWishlist';
    $pagetitle = 'Item added to wishlist';
    require (File::build_path(array("view","view.php")));
  }


}


?>
