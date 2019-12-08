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

    public function getItems() {
        try {
            $pdo = Model::$pdo;
            $sql = "SELECT I.id, I.name, IC.quantity FROM item I JOIN itemcommand IC ON IC.id_item=I.id WHERE IC.id_command=:tag_id_command";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "tag_id_command" => $this->id_command,
            );
            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_ASSOC);
            $tab_item = $req_prep->fetchAll();
            // Attention, s'il n'y a pas de résultats, on renvoie false
			return $tab_item;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

	public function saveItems($basket) {
		try {
			$pdo = Model::$pdo;
			$sql = "INSERT INTO `itemcommand` (`id_command`, `id_item`, `quantity`) VALUES (:tag_id_command, :tag_id_item, :tag_quantity);";
			$req_prep = Model::$pdo->prepare($sql);
			foreach($basket as $item) {
				$values = array(
					"tag_id_command" => $this->get('id_command'),
					"tag_id_item" => $item->get('id'),
					"tag_quantity" => $_SESSION['basket'][$item->get('id')],
				);
				$req_prep->execute($values);
			}
		} catch (PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			} else {
				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			}
			die();
		}
	}

    public function buyBasket() {
	    $basket = ModelBasket::buildBasketFromCookie();
	    $data = array('id_command' => $this->id_command, 'login_user' => $this->login_user, 'date_buy' => $this->date_buy);
	    $this->save($data);
        $this->selectLastUserCommand();
        $this->saveItems($basket);
    }

	/* Une fois la commande créé dans la BD à partir de l'objet on récupère l'id_command
	 * et on met à jour l'objet*/

    public function selectLastUserCommand() {
        try {
            $req_prep = Model::$pdo->prepare("SELECT id_command FROM command WHERE login_user = :primary AND date_buy = (SELECT MAX(date_buy) FROM command WHERE login_user = :primary)");
            $values = array("primary" => $this->login_user);
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
        else {
        	$this->set('id_command',$tab[0]['id_command']);
        	return $tab[0]['id_command'];
		}
    }
}

?>