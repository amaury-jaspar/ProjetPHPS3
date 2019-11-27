<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelTest extends Model {

    protected static $object = "test";

  public function __construct($data = NULL) {
    if (!is_null($data)) {
    }
  }

  public function get($nom_attribut) {
    if (property_exists($this, $nom_attribut))
      return $this->$nom_attribut;
    return false;
  }

  public function set($nom_attribut, $valeur) {
    if (property_exists($this, $nom_attribut))
      $this->$nom_attribut = $valeur;
    return false;
  }
}

?>
