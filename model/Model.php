<?php

require_once (File::build_path(array('conf', 'Conf.php')));
require_once (File::build_path(array('lib', 'QueryBuilder.php')));

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
			$myRequest = new QueryBuilder;
			$myRequest->select('*')->from($table_name)->where($primary_key, "=", ":primary");
//			$sql = "SELECT * from $table_name WHERE $primary_key = :primary";
			$req_prep = Model::$pdo->prepare($myRequest->getSQL());
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

	public static function selectFromArray($data) {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		$sql_query = "SELECT * FROM $table_name WHERE ";
		$length = count($data);
		foreach ($data as $key => $value) {
			$sql_query = $sql_query . $key . "=" . " :value_" . $key;
			if (--$length) {
				$sql_query = $sql_query . " AND ";
			}
		}
		try {
			$req_prep = Model::$pdo->prepare($sql_query);
			var_dump($sql_query);
			$values = array();
			foreach ($data as $key => $value) {
				$values['value_' . $key] = $value;
			}
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
			$myRequest = new QueryBuilder;
			$myRequest->select('*')->from($table_name);
//		 	$sql = "SELECT * FROM $table_name";
			$req_prep = Model::$pdo->query($myRequest->getSQL());
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

	public static function selectWhere($attribut, $value) {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$myRequest = new QueryBuilder;
			$myRequest->select('*')->from($table_name)->where(":attribut", "=", ":value");
//			 $sql = "SELECT * FROM $table_name WHERE :attribut = :value"
			$req_prep = Model::$pdo->prepare($myRequest->getSQL());
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

	public static function selectWhereFromArray($data) {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		$sql_query = "SELECT * FROM $table_name WHERE ";
		$length = count($data);
		foreach ($data as $key => $value) {
			$sql_query = $sql_query . $key . "=" . " :value_" . $key;
			if (--$length) {
				$sql_query = $sql_query . " AND ";
			}
		}
		try {
			$req_prep = Model::$pdo->prepare($sql_query);
			$values = array();
			foreach ($data as $key => $value) {
				$values['value_' . $key] = $value;
			}
			$req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_ASSOC);
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
		$values = array();
		foreach ($data as $cle => $value) {
			if ($cle != $primary_key) {
				$SET = $SET . "$cle = :$cle, ";
			}
			$values[$cle] = $value;
		}
		$SET = rtrim($SET, ", ");
		$sql = "UPDATE $table_name $SET WHERE $primary_key = :$primary_key";
		try {
			$req_prep = Model::$pdo->prepare($sql);
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

	public static function updateWhere($attribut, $value) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		try {
			$req_prep = Model::$pdo->prepare("UPDATE $table_name SET :attribut = :value WHERE $primary_key = :$primary_key");
			$values = array(
				'values' => $value,
				'attribut' => $attribut
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

	public function save($data) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		$INSERINTO = "INSERT INTO " . $table_name . "(";
		$VALUES = "VALUES (";
		foreach ($data as $cle => $valeur) {
			$INSERINTO = $INSERINTO . $cle . ", ";
			$VALUES = $VALUES . ":" . $cle . ", ";
		}
		$INSERINTO = rtrim($INSERINTO, ", ");
		$INSERINTO = $INSERINTO . ")";
		$VALUES = rtrim($VALUES, ", ");
		$VALUES = $VALUES . ")";
		$sql = $INSERINTO . " " . $VALUES;
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

}

Model::Init();

?>
