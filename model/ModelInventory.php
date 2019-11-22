<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelInventory extends Model {

  private $login_user;
  private $item_id;

  protected static $object = "inventory";
  protected static $primary = "login_user";

  public function __construct($data=NULL) {
    if (!is_null($data)) {
      $this->login_user = $data['login_user'];
      $this->item_id = $data['item_id'];
    }
  }

  public function get($attribute) {
    return $this->$attribute;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
  }
}

?>
