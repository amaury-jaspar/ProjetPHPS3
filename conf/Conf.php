<?php

class Conf {

    static private $databases = array (
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        // le nom de la base de donnée
        'database' => 'simondonj',
        // root
        'login' => 'simondonj',
        // mdp créer à l'installation, certainement un root
        'password' => '07C4XS02ID7'
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
