<?php

require_once (File::build_path(array('conf', 'Conf.php')));

class Model {

	public static $pdo;

	public static function Init() {
		$login = Conf::getLogin();
		$password = Conf::getPassword();
		$database_name = Conf::getDatabase();
		$hostname = Conf::getHostname();

		try {
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			if(Conf::getDebug()) {
			echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}



	public static function select($primary_value) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->prepare("SELECT * from $table_name WHERE $primary_key = :primary");
			$values = array("primary" => $primary_value);
			$req_prep->execute($values);
			$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
			$tab = $req_prep->fetchAll();
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if (empty($tab))
			return false;
		return $tab[0];
	}



	public static function selectAll() {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->query("SELECT * FROM $table_name");
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



		// Inutile à l'heure actuelle
		// A tester, pas sûr que la préparation des valeurs à insérer soi correct
	public static function selectWhere($attribut, $value) {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->prepare("SELECT * FROM $table_name WHERE :attribut = :value");
			$values = array (
				"attribut" => $attribut,
				"value" => $value
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



	public static function deleteById($primary_value) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		try {
			$req_prep = Model::$pdo->prepare("DELETE FROM $table_name WHERE $primary_key = :primary");
			$values = array(
				"primary" => $primary_value,
			);
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}

	public static function updateByID($data) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$SET = "SET ";
		foreach ($data as $cle => $valeur) {
			if ($cle != $primary_key) {
				$SET = $SET . "$cle=:$cle, ";
			}
		}
		$SET = rtrim($SET, ", ");
		try {
			$req_prep = Model::$pdo->prepare("UPDATE $table_name $SET WHERE $primary_key = :$primary_key");
			$values = array();
			foreach ($data as $cle => $valeur) {
					$maclef = ":" . $cle;
					$values[$maclef] = $valeur;
			}
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}

	public function save($data) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$VALUES = "VALUES (";
		foreach ($data as $cle => $valeur) {
				$VALUES = $VALUES . ":" . $cle . ", ";
		}
		$VALUES = rtrim($VALUES, ", ");
		$VALUES = $VALUES . ")";
		$sql = 'INSERT INTO ' . $table_name . " " . $VALUES;
		try {
			$req_prep = Model::$pdo->prepare($sql);
			$values = array();
			foreach ($data as $cle => $valeur) {
					$maclef = ":" . $cle;
					$values[$maclef] = $valeur;
			}
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}

	/*
	$e->getCode() == 23000
	*/
	
}

Model::Init();

?>