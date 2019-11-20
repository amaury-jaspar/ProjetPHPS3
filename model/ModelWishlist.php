<?php

require_once (File::build_path(array('model', 'Model.php')));
require_once (File::build_path(array('lib', 'Security.php')));

class ModelWishlist extends Model {

  private static $user_id;
  private static $item_id;

  protected static $object = "item";
  protected static $primary = "user_login";

  public function __construct($data=NULL) {
    if (!is_null($data)) {
      $this->user_id = $data['user_id'];
      $this->item_id = $data['item_id'];
    }
  }

  public function get($attribute) {
    return $this->$attribute;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
  }

  public static function selectAll($user_id) {
		$table_name = static::$object;
    $primary_key = static::$primary;
		$class_name = 'Model' . ucfirst($table_name);
		try {
			$req_prep = Model::$pdo->query(
        "SELECT * FROM $table_name WHERE $primary_key = :login"
      );
      $values = array(
        'login' => $user_id,
      );
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
