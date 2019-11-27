<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelWishlist extends Model {

  private $login_user;
  private $item_id;

  protected static $object = "wishlist";
  protected static $primary = "login_user";

  public function __construct($data=NULL) {
    if (!is_null($data)) {
      $this->login_user = $data['login_user'];
      $this->item_id = $data['item_id'];
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

  public static function selectItems($value) {
    $primary_key = static::$primary;
    $table_name = static::$object;
    try {
      $req_prep = Model::$pdo->prepare("SELECT * FROM $table_name WHERE login_user = :value");
      $values = array(
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

  public static function deleteItem($login_user, $item_id) {
		$table_name = static::$object;
		try {
			$req_prep = Model::$pdo->prepare("DELETE FROM $table_name WHERE login_user= :primary AND item_id= :item_id");
			$values = array(
				"primary" => $login_user,
        "item_id" => $item_id
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
}

?>
