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
      $data = array(
      "login_user" => $login_user
    );
    $current_wishlist = ModelWishlist::selectWhereFromArray($data);
    foreach ($current_wishlist as $tuple) {
      $current_item = ModelItem::select($tuple['item_id']);
      $tab_item_id[] = $current_item->get('id');
    }
    if (! in_array($item_id, $tab_item_id)) {
      $wishlist = new ModelWishlist($login_user, $item_id);
      $data = array (
        'login_user' => $login_user,
        'item_id' => $item_id
      );
      $item = ModelItem::select(myGet('id'));
      $wishlist->save($data);
      $view = 'addedToWishlist';
      $pagetitle = 'Item added to wishlis}t';
      require (File::build_path(array("view","view.php")));
    } else {
      $item = ModelItem::select(myGet('id'));
      $view = 'alreadyInWishlist';
      $pagetitle = 'Item already in wishlist';
      require (File::build_path(array("view","view.php")));
    }
  }

  public static function removeFromWishlist() {
    $login_user = $_SESSION['login'];
    $item_id = myGet('id');
    ModelWishlist::deleteItem($login_user, $item_id);
    $view = 'removedFromWishlist';
    $pagetitle = 'Item removed from wishlist';
    require (File::build_path(array("view","view.php")));
  }


}


?>
