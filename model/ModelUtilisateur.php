<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelUtilisateur extends Model {

    private $login;
    private $nom;
    private $prenom;
    private $admin;
    private $mail;
    private $wallet;

    protected static $object = "utilisateur";
    protected static $primary = "login";

    public function __construct($l = NULL, $n = NULL, $p = NULL, $ad = NULL, $m = NULL) {
        if (!is_null($l) && !is_null($n) && !is_null($p) && !is_null($ad)) {
            $this->login = $l;
            $this->nom = $n;
            $this->prenom = $p;
            $this->admin = $ad;
            $this->mail = $m;
            $this->wallet = 0;
        }
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
        $this->saveUpdate();
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        $this->saveUpdate();
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        $this->saveUpdate();
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
        $this->saveUpdate();
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
        $this->saveUpdate();
    }

    public function getWallet() {
        return $this->wallet;
    }

    public function setWallet($wallet) {
        $this->wallet = $wallet;
        $this->saveUpdate();
    }

    // Getter générique
    public function get($property) {

        if ($property == "login") {
            return $this->login;
        } else if ($property == "nom") {
            return $this->nom;
        } else if ($property == "prenom") {
            return $this->prenom;
        } else if ($property == "password") {
            return $this->password;            
        } else {
            throw new Exception('Propriété invalide !');
        }
    }

    // Setter générique
    public function set($property, $valeur) {

        if ($property == "login") {
            $this->login = $valeur;
            $this->saveUpdate();
        } else if ($property == "nom") {
            $this->nom = $valeur;
            $this->saveUpdate();
        } else if ($property == "prenom") {
            $this->prenom = $valeur;
            $this->saveUpdate();
        } else if ($property == "password") {
            $this->password = $valeur;
            $this->saveUpdate();
        } else {
            throw new Exception('Propriété invalide !');
        }
    }

    public function saveUpdate() {
        $data = array (
            'login' => $this->getLogin(),
           'nom' => $this->getNom(),
           'prenom' => $this->getPrenom(),
           'admin' => $this->getAdmin(),
           'mail' => $this->getMail(),
           'wallet' => $this->getWallet()
        );
        ModelUtilisateur::updateByID($data);
    }

        // modifier la requête pour pouvoir compter le nombre de résultat et ne renvoyer true que s'il n'y a qu'un seul couple Login / mdp
    public static function checkPassword($login, $mot_de_passe_chiffre) {
        $rep = Model::$pdo->query('SELECT * FROM utilisateur WHERE login = "'.$login.'" AND password = "'.$mot_de_passe_chiffre.'"');
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $array = $rep->fetchAll();
        return $array[0];
//        print_r($rep);
//        if (!is_null($rep)) {
//            return true;
//        } else {
//            return false;
//        }
    }

        // Quand on se connecte, on vérifie que le champ nonce de la relation utilisateur est vide.
        // S'il n'est pas vide, c'est que l'utilisateur n'a pas valider son compte et il doit donc d'abord en passer par le mail qui lui a été envoyé.
    public static function checkNonce($login) {
        $rep = Model::$pdo->query("SELECT nonce FROM utilisateur WHERE login = $login");
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $array = $rep->fetchAll();
        return $array[0];
    }

    public static function nonceAndId($login, $nonce) {
        $rep = Model::$pdo->query("SELECT * FROM utilisateur WHERE login = '$login' AND nonce = '$nonce';");
//        UPDATE utilisateur SET nonce = '' WHERE login = '4321' AND nonce = '9be9ea7dcd45c5c292d3b9768e5d6607';
        $rep->setFetchMode(PDO::FETCH_ASSOC);
        $array = $rep->fetchAll();
        return $array[0];
    }

    public static function eraseNonce($login, $nonce) {
        $sql = "UPDATE utilisateur SET nonce = '' WHERE login = '$login' AND nonce = '$nonce'";
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
    }

    public function addMoney($credit) {
        $wallet = $this->getWallet();
        $wallet += $credit;
        ModelUtilisateur::setWallet($wallet);
        // Ajouter un appel à la fonction save afin d'écrire la transaction dans la BD
    }

    public function substractMoney($debit) {
        $test = $this->getWallet();
        $test -= $debit;
        $this->setWallet($test);
        // Ajouter un appel à la fonction save afin d'écrire la transaction dans la BD
    }

}

?>