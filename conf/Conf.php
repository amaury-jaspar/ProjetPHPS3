<?php

class Conf {

    static private $databases = array (
        'hostname' => 'localhost:8889',
        // le nom de la base de donnée
        'database' => 'dominionVente',
        // root
        'login' => 'root',
        // mdp créer à l'installation, certainement un root
        'password' => 'root'
        // a remplir
    );

    static private $debug = True;

    static public function getDebut() {
        return self::$debug;
    }

    static public function getLogin() {
        return self::$databases['login'];
      }

    static public function getDatabase() {
        return self::$databases['database'];
    }

    static public function getHostname() {
        return self::$databases['hostname'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }

}

?>