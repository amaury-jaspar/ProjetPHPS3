<?php

require_once (File::build_path(array('model', 'ModelWishlist.php')));
require_once (File::build_path(array('model', 'ModelItem.php')));
require_once (File::build_path(array('model', 'ModelBasket.php')));
require_once (File::build_path(array('lib', 'Session.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerWishlist {

  protected static $object = 'wishlist';

  public static function read() {
    $login_user = $_SESSION['login'];
    $data = array(
      "login_user" => $login_user
    );
    $wishlist = ModelWishlist::selectWhereFromArray($data);
    if (!empty($wishlist)) {
      $tab_wishes = array();
      foreach ($wishlist as $tuple) {
        $current_item = ModelItem::select($tuple['item_id']);
        $tab_wishes[] = $current_item;
      }
    }
    $view = 'list';
    $pagetitle = 'Wishlist';
    require(File::build_path(array('view','view.php')));
  }

  public static function addItem() {
    $login_user = $_SESSION['login'];
    $item_id = myGet('id');
    $item = ModelItem::select($item_id);
    $data = ModelWishlist::add($login_user, $item);
    if ($data != null) {
        $view = 'addedToWishlist';
        $pagetitle = 'Item added to wishlis}t';
        require (File::build_path(array("view","view.php")));
    } else {
        $view = 'alreadyInWishlist';
        $pagetitle = 'Item already in wishlist';
        require (File::build_path(array("view","view.php")));
    }
  }

  public static function removeFromWishlist() {
    $login_user = $_SESSION['login'];
    $item_id = myGet('id');
    $item = ModelItem::select($item_id);
    ModelWishlist::deleteItem($login_user, $item_id);
    $view = 'removedFromWishlist';
    $pagetitle = 'Item removed from wishlist';
    require (File::build_path(array("view","view.php")));
  }


}


?>
