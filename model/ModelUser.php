<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelUser extends Model {

	private $login;
	private $lastName;
	private $surname;
	private $mail;
	private $admin;
	private $wallet;

	protected static $object = "user";
	protected static $primary = "login";

	// passer les construteur avec un $data en argument pour rendre ça plus conçis
	// et déclarer le tableau directement dans les parenthèses d'une fonction

	public function __construct($l = NULL, $n = NULL, $p = NULL, $m = NULL, $a = NULL, $w = NULL) {
		if (!is_null($l) && !is_null($n) && !is_null($p) && !is_null($m) && !is_null($a) && !is_null ($w)) {
			$this->login = $l;
			$this->lastName = $n;
			$this->surname = $p;
			$this->mail = $m;
			$this->admin = $a;
			$this->wallet = $w;
		}
	}

	// Faire les getter générique

	public function getLogin() {
		return $this->login;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	public function getSurname() {
		return $this->surname;
	}

	public function setSurname($surname) {
		$this->surname = $surname;
	}

	public function getMail() {
		return $this->mail;
	}

	public function setMail($mail) {
		$this->mail = $mail;
	}

    public function getAdmin() {
        return $this->admin;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function getWallet() {
        return $this->admin;
    }

    public function setWallet($wallet) {
        $this->admin = $admin;
    }

    public static function checkPassword($login, $mot_de_passe_chiffre) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		try {
			$req_prep = Model::$pdo->prepare("SELECT COUNT(*) FROM $table_name WHERE $primary_key = :login AND password = :mdp");
			$values = array (
				"login" => $login,
				"mdp" => $mot_de_passe_chiffre,
			);
			$req_prep->execute($values);
			$answer = $req_prep->setFetchMode(PDO::FETCH_ASSOC);
			echo $answer;
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		return $answer;
	}

}

?>