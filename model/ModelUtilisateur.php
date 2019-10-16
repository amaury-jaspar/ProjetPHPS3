<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelUser extends Model {

	private $login;
	private $lastName;
	private $surname;

	protected static $object = "user";
	protected static $primary = "login";

	public function __construct($l = NULL, $n = NULL, $p = NULL) {
		if (!is_null($l) && !is_null($n) && !is_null($p)) {
			$this->login = $l;
			$this->lastName = $n;
			$this->surname = $p;
		}
	}

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

	public function getAdmin() {
		return $this->admin;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
	}

	public function getMail() {
		return $this->mail;
	}

	public function setMail($mail) {
		$this->mail = $mail;
	}

	public function getWallet() {
		return $this->wallet;
	}

	public function setWallet($wallet) {
		$this->wallet = $wallet;
	}

}

?>