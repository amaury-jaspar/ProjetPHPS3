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

}

?>