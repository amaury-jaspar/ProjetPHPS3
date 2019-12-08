<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelItem extends Model {

	private $id;
	private $name;
	private $price;
	private $description;
	private $category;
	private $catalog;
	private $nbbuy;
	private $dateadd;
	private $levelaccess;

	protected static $object = "item";
	protected static $primary = "id";

    public function __construct($data = NULL) {
        if (!is_null($data)) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->price = $data['price'];
            $this->description = $data['description'];
			$this->category = $data['category'];
			$this->catalog = $data['catalog'];
			$this->nbbuy = $data['nbbuy'];
			$this->dateadd = $data['dateadd'];
			$this->levelaccess = $data['levelaccess'];
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

	// utile à la pagination de article afin de compter tous les produits qui sont à vendre
    public static function countCatalog() {
		$primary_key = static::$primary;
		$table_name = static::$object;
		try {
			$rep = Model::$pdo->query("SELECT COUNT($primary_key) as nb_Id FROM $table_name WHERE catalog = 1");
			$answer = $rep->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		return $answer['nb_Id'];
	}

    public static function countCatalogCategory($condition) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $alias = $table_name[0];
		try {
			$req_prep = Model::$pdo->prepare("SELECT COUNT($alias.$primary_key) as nb_Id FROM $table_name $alias WHERE catalog = 1 AND category = :condition");
			$values = array("condition" => $condition);
			$req_prep->execute($values);
			$answer = $req_prep->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		return $answer[0]['nb_Id'];
    }

	// utile à la pagination de article
	public static function selectPage($currentPage, $parPage) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$rep = Model::$pdo->query("SELECT * FROM $table_name WHERE catalog = 1 ORDER BY $primary_key ASC LIMIT " .(($currentPage-1)*$parPage) .",$parPage");
			$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
			$tab_obj = $rep->fetchAll();
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if (empty($tab_obj))
			return false;
		return $tab_obj;
	}

    // utile à la pagination de article
    public static function selectPageCategory($currentPage, $parPage, $condition) {
		$primary_key = static::$primary;
        $table_name = static::$object;
		$alias = $table_name[0];
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->prepare("SELECT $alias.* FROM $table_name $alias WHERE catalog = 1 AND category = :condition ORDER BY $primary_key ASC LIMIT " .(($currentPage-1)*$parPage) .",$parPage");
			$values = array ("condition" => $condition);
			$req_prep->execute($values);
			$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
			$tab_obj = $req_prep->fetchAll();
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if (empty($tab_obj))
			return false;
		return $tab_obj;
    }

	public static function selectFromSearch($currentPage, $parPage, $search) {
		$primary_key = static::$primary;
        $table_name = static::$object;
		$alias = $table_name[0];
		$class_name = 'Model' . ucfirst($table_name);
		$search = '%' . $search . '%';
		try {
			$req_prep = Model::$pdo->prepare("SELECT $alias.* FROM $table_name $alias WHERE name LIKE :search AND catalog = 1 ORDER BY $primary_key ASC LIMIT " .(($currentPage-1)*$parPage) .",$parPage");
			$values = array (
				"search" => $search
			);
			$req_prep->execute($values);
			$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
			$tab_obj = $req_prep->fetchAll();
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if (empty($tab_obj))
			return false;
		return $tab_obj;
	}

}

?>
