<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelItem extends Model {
	
	private $id;
	private $name;
	private $price;
	private $description;
	
	protected static $object = "item";
	protected static $primary = "id";

	/**
	 * Item constructor
	 * The id and name are required to add the item to the database, the description and price can be added later on
	 */
	public function __construct($i = NULL, $n = NULL, $p = NULL, $d = NULL) {
		if (!is_null($i) && !is_null($n) && !is_null($p) && !is_null($d)) {
			$this->id = $i;
			$this->name = $n;
			$this->price = $p;
			$this->description = $d;
		}	
	}

	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setPrice($price) {
		$this->name = $price;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

}



?>