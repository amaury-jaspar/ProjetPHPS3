<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelUser extends Model {

	private $login;
	private $lastName;
	private $surname;
	private $mail;

	protected static $object = "user";
	protected static $primary = "login";

	public function __construct($l = NULL, $n = NULL, $p = NULL, $e = NULL) {
		if (!is_null($l) && !is_null($n) && !is_null($p) && !is_null($e)) {
			$this->login = $l;
			$this->lastName = $n;
			$this->surname = $p;
			$this->mail = $e;
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

		// cherche dans la BDD les couples login / mots de passe, et renvoie vrais s'il n' a en qu'un seul, faux sinon
		// Ne pas oublier de rajouter les try catch ici autour de l'objet PDO
		// On doit pouvoir faire une meilleure requête, qui fait un count, voir même qui exploite une procédure, à voir.
		// Renvoie true si la pair existe et que count = 1, si différent de 1, doit renvoyer false
    public static function checkPassword($login, $mot_de_passe_chiffre) {
        $rep = Model::$pdo->query('SELECT * FROM user WHERE login = "'.$login.'" AND password = "'.$mot_de_passe_chiffre.'"');
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $array = $rep->fetchAll();
        return $array[0];
//		if (!is_null($rep)) {
//            return false;
//		} else {
//            return true;
//        }
	}

}

?>