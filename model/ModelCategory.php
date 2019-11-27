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
