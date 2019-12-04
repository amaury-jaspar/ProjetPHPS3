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
			$this->date_buy = NULL;
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
/*
    public static function findItems($id_command) {
        try {
            $pdo = Model::$pdo;
            $sql = "SELECT I.*, IC.quantity FROM items I JOIN itemcommand IC ON IC.id_item=I.id WHERE IC.id_command=:tag_id_command";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "tag_id_command" => $id_command,
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_ARRAY);
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


    public function save($login__user, $currentBasket) {
        try {
            $INSERT_Command = "INSERT INTO `command` (`id_command`, `login_user`, `date`) VALUES (NULL,"."$login__user".", NULL);";
            foreach($currentBasket as $item) {
                $itemQuantity = $tab_basket[$item->get('id')]);
                $itemIdURL = rawurlencode($item->get('id'));
                $INSERT_item = "INSERT INTO `itemcommand` (`id_command`, `id_item`, `quantity`) VALUES (" . ", '9d5216e07ba24a9999ef1d669ed7ba0f', '7'";
            }
            $INSERINTO = rtrim($INSERINTO, ", ");
            $INSERINTO = $INSERINTO . ")";
            $VALUES = rtrim($VALUES, ", ");
            $VALUES = $VALUES . ")";
            $sql = $INSERINTO . " " . $VALUES;
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
*/

    public function selectLastUserCommand($login_user) {
        try {
            $req_prep = Model::$pdo->prepare("SELECT id_command FROM command WHERE login_user = :primary AND date = (SELECT MAX(date) FROM command WHERE login_user = :primary)");
            $values = array("primary" => $login_user);
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
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
}

?>