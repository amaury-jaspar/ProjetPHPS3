<?php

class ModelItem {
	
	private $id;
	private $name;
	private $price;
	private $description;


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
	}public function setName($name) {
		$this->name = $name;
	}

	public function getItemByID($id) {
		return Model::selectWhere('id',$id);
	}



}



?>