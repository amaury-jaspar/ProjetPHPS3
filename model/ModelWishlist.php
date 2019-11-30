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

  public function get($attribute) {
    return $this->$attribute;
  }

  public function set($attribute, $value) {
    $this->$attribute = $value;
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
