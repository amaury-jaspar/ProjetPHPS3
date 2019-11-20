<?php

require_once (File::build_path(array('model', 'ModelWishlist.php')));
require_once (File::build_path(array('lib', 'Session.php')));

/**
 *
 */
class ControllerWishlist {

  protected static $object = 'whislist';

  public static function read() {
    $user_id = htmlspecialchars(Routeur::myGet('user_id'));
    $tab_item = ModelWishlist::selectAll();
    $view = 'list';
    $pagetitle = 'Wishlist';
    require(File::build_path(array('view','view.php')));
  }

  public static function addItem() {
    $user_id = $_SESSION['login'];
    $item_id = Routeur::myGet('item_id');
  }


}


?>
