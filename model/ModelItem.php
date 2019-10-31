<?php

class ModelItem {
	
	private $id;
	private $name;
	private $price;
	private $description;
	
	/**
	 * Item constructor
	 * The id and name are required to add the item to the database, the description and price can be added later on
	 */
	public function __construct($id, $name, $price, $description) {
		if (!is_null($id) && !is_null($name)) {
			$this->id = $id;
			$this->name = $name;
			$this->price = $price;
			$this->description = $description;
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

	public function getAllItems() {
		return Model::selectAll();
	}
	
	public function getItemByID($id) {
		return Model::selectWhere('id',$id);
	}



}



?>