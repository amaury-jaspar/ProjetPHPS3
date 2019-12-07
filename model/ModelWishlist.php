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

  public static function add($login_user, $item) {
      $user = array(
          "login_user" => $login_user
      );
      $item_id = $item->get('id');
      $current_wishlist = ModelWishlist::selectWhereFromArray($user);
      foreach ($current_wishlist as $tuple) {
          $current_item = ModelItem::select($tuple['item_id']);
          $tab_item_id[] = $current_item->get('id');
      }
      if (! in_array($item_id, $tab_item_id)) {
          $data = array (
              'login_user' => $login_user,
              'item_id' => $item_id
          );
          $wishlist = new ModelWishlist($data);
          $wishlist->save($data);
          return $data;
      } else {
          return null;
      }
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
