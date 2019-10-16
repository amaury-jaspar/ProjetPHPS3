<?php

require_once (File::build_path(array('conf', 'Conf.php')));

class Model {

    public static $pdo;

    public static function Init() {
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        $database_name = Conf::getDatabase();
        $hostname = Conf::getHostname();

        // On crée la connexion avec la BD à l'aide de l'objet PDO
        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            if(Conf::getDebug()) {
            echo $e->getMessage();
            } else {
                echo 'Une erreur est survenue <a href=""> retour à la page d\'acceuil </a>';
            }
            die();
        }
    }

    public static function select($primary_value) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare("SELECT * from $table_name WHERE $primary_key = :nom_tag");
        // On prépare le tableau de valeur à insérer
        $values = array(
            "nom_tag" => $primary_value,
        );
        // On donne les valeurs et on exécute la requête	
        $req_prep->execute($values);
        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $tab = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab))
            return false;
        return $tab[0];
    }

    public static function selectAll() {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $rep = Model::$pdo->query("SELECT * FROM $table_name");
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        return $rep->fetchAll();
        if (empty($tab))
            return false;
        return $tab;
    }

        // Inutile à l'heure actuelle
        // A tester, pas sûr que la préparation des valeurs à insérer soi correct
    public static function selectWhere($attribut, $valeur) {
        $table_name = static::$object;
        $class_name = 'Model' . ucfirst($table_name);
        $rep = Model::$pdo->query("SELECT * FROM $table_name WHERE :attribut = :valeur");
        $values = array(
            "attribut" => $attribut,
            "valeur" => $valeur
        );
        $req_prep->execute($values);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        if (empty($tab))
            return false;
        return $tab;
    }

    public static function deleteById($primary_value) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $req_prep = Model::$pdo->prepare("DELETE FROM $table_name WHERE $primary_key = :nom_tag");
        $values = array(
            "nom_tag" => $primary_value,
        );
        $req_prep->execute($values);
    }

    public static function updateByID($data) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $SET = "SET ";
        foreach ($data as $cle => $valeur) {
            if ($cle != $primary_key) {
                $SET = $SET . "$cle=:$cle, ";
            }
        }
        $SET = rtrim($SET, ", ");
        $req_prep = Model::$pdo->prepare("UPDATE $table_name $SET WHERE $primary_key = :$primary_key");
        $values = array();
        foreach ($data as $cle => $valeur) {
                $maclef = ":" . $cle;
                $values[$maclef] = $valeur;
        }
        $req_prep->execute($values);
    }

    public function save($data) {
        $primary_key = static::$primary;
        $table_name = static::$object;
        $VALUES = "VALUES (";
        foreach ($data as $cle => $valeur) {
                $VALUES = $VALUES . ":" . $cle . ", ";
        }
        $VALUES = rtrim($VALUES, ", ");
        $VALUES = $VALUES . ")";
        $sql = 'INSERT INTO ' . $table_name . " " . $VALUES;
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        foreach ($data as $cle => $valeur) {
                $maclef = ":" . $cle;
                $values[$maclef] = $valeur;
        }
        $req_prep->execute($values);
    }

}

Model::Init();

?>