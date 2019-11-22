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

	public function __construct($data = NULL) {
		if (!is_null($data)) {
			$this->login = $data['login'];
			$this->lastName = $data['lastName'];
			$this->surname = $data['surname'];
			$this->mail = $data['mail'];
			$this->admin = $data['admin'];
			$this->wallet = $data['wallet'];
		}
	}

	public function get($nom_attribut) {
		return $this->$nom_attribut;
	}

	public function set($nom_attribut, $valeur) {
		$this->$nom_attribut = $valeur;
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
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if ($answer['COUNT(*)'] == 0) {
			return false;
		} else {
			return true;
		}
	}

	// Quand on se connecte, on vérifie que le champ nonce de la relation user est vide.
	// S'il n'est pas vide, c'est que l'utilisateur n'a pas valider son compte et il doit donc d'abord en passer par le mail qui lui a été envoyé.
	public static function checkNonce($login) {
		try {
			$req_prep = Model::$pdo->prepare("SELECT nonce FROM user WHERE login = :login");
			$values = array ("login" => $login);
			$req_prep->execute($values);
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);	
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if ($answer['nonce'] !== "") {
			return false;
		} else {
			return true;
		}
	}

	public static function nonceAndId($login, $nonce) {
		try {
			$req_prep = Model::$pdo->prepare("SELECT * FROM user WHERE login = :login AND nonce = :nonce");
			$values = array (
				"login" => $login,
				"nonce" => $nonce
			);
			$req_prep->execute($values);
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);
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

	public static function eraseNonce($login, $nonce) {
		try {			
			$req_prep = Model::$pdo->prepare("UPDATE user SET nonce = NULL WHERE login = :login AND nonce = :nonce");
			$values = array (
				"login" => $login,
				"nonce" => $nonce
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
/*
    public function addMoney($credit) {
        $amount = $this->get('wallet');
        $amount += $credit;
        $user->set('wallet', $amount);
		Model::updateWhere('wallet', $amount);
    }

    public function substractMoney($debit) {
		echo 'substractMoney';
		var_dump($this);
		$amount = $this->get('wallet');

		$amount -= $debit;
        $this->set('wallet', $amount);
		Model::updateWhere('wallet', $amount);
    }
*/

}

?>