<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once (File::build_path(array('lib', 'Security.php')));

class ModelWishlist extends Model {

  private static $login_user;
  private static $item_id;

  protected static $object = "wishlist";
  protected static $primary = "login_user";

  public function __construct($data=NULL) {
    if (!is_null($data)) {
      $this->login_user = $data['login_user'];
      $this->item_id = $data['item_id'];
    }
  }

  public function get($attribute) {
    return $this->$attribute;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
  }

  public static function selectAll($login_user) {
		$table_name = static::$object;
    $primary_key = static::$primary;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->prepare(
        "SELECT * FROM $table_name WHERE $primary_key = :login"
      );
      $values = array(
        "login" => $login_user,
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
