<?php

class Conf {

    static private $databases = array (
        'hostname' => '',
        // le nom de la base de donnée
        'database' => '',
        // root
        'login' => '',
        // mdp créer à l'installation, certainement un root
        'password' => ''
        // a remplir
    );

    static private $debug = False;

    static public function getDebug() {
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
