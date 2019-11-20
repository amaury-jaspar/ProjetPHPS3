<?php

require_once (File::build_path(array('lib', 'Session.php')));

/**
 *
 */
class ControllerWishlist {

  protected static $object = 'whilist';

  public function __construct(argument) {
    // code...
  }

  public static function addItem() {
    $user_id = $_SESSION['login'];
    
  }


}


?>
