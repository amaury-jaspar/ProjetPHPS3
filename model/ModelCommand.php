<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelCommand extends Model {

	private $id_command;
	private $login_user;
	private $id_item;
	private $quantity_item;
	private $date_buy;

	protected static $object = "command";
	protected static $primary = "";

	public function __construct($data = NULL) {
		if (!is_null($data)) {
			$this->id_command = NULL;
			$this->login_user = $data['login_user'];
			$this->id_item = $data['id_item'];
			$this->quantity_item = $data['quantity_item'];
			$this->date_buy = date();
		}
	}

	public function get($nom_attribut) {
		return $this->$nom_attribut;
	}

	public function set($nom_attribut, $valeur) {
		$this->$nom_attribut = $valeur;
	}

}

?>