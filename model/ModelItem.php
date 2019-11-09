<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once (File::build_path(array('lib', 'Security.php')));

class ModelItem extends Model {
	
	private $id;
	private $name;
	private $price;
	private $description;
	private $category;
	
	protected static $object = "item";
	protected static $primary = "id";

	/**
	 * Item constructor
	 * The id and name are required to add the item to the database, the description and price can be added later on
	 */
    public function __construct($n = NULL, $p = NULL, $d = NULL, $cat = NULL) {
        if (!is_null($n) && !is_null($p) && !is_null($d) && !is_null($cat)) {
            $this->id = Security::generateRandomHex();
            $this->name = $n;
            $this->price = $p;
            $this->description = $d;
            $this->category = $cat;
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

	public function getCategory() {
		return $this->category;
	}

	public function setCategory($category) {
		$this->category = $category;
	}

	// utile à la pagination de article afin de compter tous les produits qui sont à vendre
    public static function countCatalog() {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $rep = Model::$pdo->query("SELECT COUNT($primary_key) as nb_Id FROM $table_name WHERE catalog = 1");
        $answer = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $answer[0];
	}

    public static function countCatalogCategory($condition) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $alias = $table_name[0];
        $sql = "SELECT COUNT($alias.$primary_key) as nb_Id FROM $table_name $alias WHERE catalog = 1 AND category = '$condition'";
        $rep = Model::$pdo->query($sql);
        $answer = $rep->fetchAll(PDO::FETCH_ASSOC);
        return $answer[0];
    }

	// utile à la pagination de article
	public static function selectPage($currentPage, $parPage) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$rep = Model::$pdo->query("SELECT * FROM $table_name WHERE catalog = 1 ORDER BY $primary_key ASC LIMIT " .(($currentPage-1)*$parPage) .",$parPage");
		$answer = $rep->fetchAll(PDO::FETCH_CLASS, "ModelItem");
		// devrait être remplacé par un Fetch Class pour récupérer des objets
		return $answer;
	}

    // utile à la pagination de article
    public static function selectPageCategory($currentPage, $parPage, $condition) {
		$primary_key = static::$primary;
        $table_name = static::$object;
        $alias = $table_name[0];
        $sql = "SELECT $alias.* FROM $table_name $alias WHERE catalog = 1 AND category = '$condition' ORDER BY $primary_key ASC LIMIT " .(($currentPage-1)*$parPage) .",$parPage";
        $rep = Model::$pdo->query($sql);
        $answer = $rep->fetchAll(PDO::FETCH_CLASS, "ModelItem");
        // devrait être remplacé par un Fetch Class pour récupérer des objets
        return $answer;
    }

}

?>