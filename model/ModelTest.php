<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelTest extends Model {

    protected static $object = "test";

  public function __construct($data = NULL) {
    if (!is_null($data)) {
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
