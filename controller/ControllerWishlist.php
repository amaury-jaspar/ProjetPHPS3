<?php

require_once (File::build_path(array('model', 'ModelWishlist.php')));
require_once (File::build_path(array('model', 'ModelItem.php')));
require_once (File::build_path(array('lib', 'Session.php')));

class ControllerWishlist {

  protected static $object = 'wishlist';

  public static function read() {
    $login_user = $_SESSION['login'];
    $wishlist = ModelWishlist::selectItems('login_user', $login_user);
    $view = 'list';
    $pagetitle = 'Wishlist';
    require(File::build_path(array('view','view.php')));
  }

  public static function addItem() {
    $login_user = $_SESSION['login'];
    $item_id = Routeur::myGet('id');
    $current_wishlist = ModelWishlist::selectItems('login_user', $login_user);
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
      $wishlist->save($data);
      $view = 'addedToWishlist';
      $pagetitle = 'Item added to wishlis}t';
      require (File::build_path(array("view","view.php")));
    } else {
      $view = 'alreadyInWishlist';
      $pagetitle = 'Item already in wishlist';
      require (File::build_path(array("view","view.php")));
    }
  }


}


?>
