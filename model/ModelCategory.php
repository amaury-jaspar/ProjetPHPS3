<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelCategory extends Model {

    private $id;
    private $name;
    private $description;

    protected static $object = "category";
    protected static $primary = "id";

  public function __construct($data = NULL) {
    if (!is_null($data)) {
      $this->id = $data['id'];
      $this->name = $data['name'];
      $this->description = $data['description'];      
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
