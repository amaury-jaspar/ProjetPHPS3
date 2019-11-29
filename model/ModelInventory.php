<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelInventory extends Model {

  private $login;
  private $id_item;

  protected static $object = "inventory";
  protected static $primary1 = "login";
  protected static $primary2 = "id_item";

  public function __construct($data = NULL) {
    if (!is_null($data)) {
      $this->login = $data['login'];
      $this->id_item = $data['id_item'];
    }
  }

  public function get($attribute) {
    return $this->$attribute;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
  }

  public static function selectItems($value) {
    $primary_key = static::$primary;
    $table_name = static::$object;
    try {
      $req_prep = Model::$pdo->prepare("SELECT * FROM $table_name WHERE :attribute = :value");
      $values = array(
        "attribute" => $primary_key,
        "value" => $value
      );
      $req_prep->execute($values);
      $req_prep->setFetchMode(PDO::FETCH_ASSOC);
      $tab_obj = $req_prep->fetchAll();
      // $tab_obj = $req_prep->fetch(PDO::FETCH_ASSOC);
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

	public static function addToInventory($data) {
    $primary_key1 = 'login';
    $primary_key2 = 'id_item';
		$table_name = static::$object;
    $operator = $data['operator'];
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    $sql = "UPDATE $table_name SET quantity = quantity $operator :quantity WHERE $primary_key1 = :login AND $primary_key2 = :id_item";
    $values = array(
      'quantity' => $data['quantity'],
      'login' => $data['login'],
      'id_item' => $data['id_item'],
    );
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

}

?>
