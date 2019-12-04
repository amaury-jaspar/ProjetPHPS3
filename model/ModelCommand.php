<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelCommand extends Model {

	private $id_command;
	private $login_user;
	private $date_buy;

	protected static $object = "command";
	protected static $primary = "id_command";

	public function __construct($data = NULL) {
		if (!is_null($data)) {
			$this->id_command = NULL;
			$this->login_user = $data['login_user'];
			$this->date_buy = date();
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

    public static function findItems($id_command) {
        try {
            $pdo = Model::$pdo;
            $sql = "SELECT I.*, IC.quantity FROM items I JOIN itemcommand IC ON IC.id_item=I.id WHERE IC.id_command=:tag_id_command";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "tag_id_command" => $id_command,
            );

            $req_prep->execute($values);

            // On récupère les résultats comme précédemment
            $req_prep->setFetchMode(PDO::FETCH_ARRAY, 'ModelUtilisateur');
            $tab_items = $req_prep->fetchAll();
            // Attention, si il n'y a pas de résultats, on renvoie false
            return $tab_items;

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}

?>