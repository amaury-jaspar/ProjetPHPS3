<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));

    class ControllerUser {

        protected static $object = "user";

        public static function read() {
            $login = htmlspecialchars($_GET['login']);
            $user = ModelUser::select($login);
            if ($user == false) {
                $array = array("view", "view.php");
                $view='error';
                $pagetitle='Error Page';
                require_once (File::build_path($array));
            } else {
                $array = array("view", "view.php");
                $view='detail';
                $pagetitle='user detail';
                require_once (File::build_path($array));
            }
        }

        public static function readAll() {
            $tab_user = ModelUser::selectAll();
            $array = array("view", "view.php");
            $view='list';
            $pagetitle='User list';
            require (File::build_path($array));
        }

        public static function create() {
            $login = "";
            $nom = "";
            $prenom = "";
            $password1 = "";
            $password2 = "";
            $required = "required";
            $action = "created";
            $array = array("view", "view.php");
            $view='update';
            $pagetitle='User creation';
            require (File::build_path($array));
        }

        public static function created() {
            if ($_GET['password1'] == $_GET['password2'] && filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL)) {
                $utilisateur = new ModelUtilisateur($_GET['login'], $_GET['nom'], $_GET['prenom'], false, $_GET['mail']);
                    // il faudrait afficher une erreur si le login existe déjà
                    $data = array (
                        'login' => $utilisateur->getLogin(),
                        'nom' => $utilisateur->getNom(),
                        'prenom' => $utilisateur->getPrenom(),
                        'password' => Security::chiffrer($_GET['password1']),
                        'admin' => 0,
                        'mail' => $_GET['mail'],
                        'nonce' => Security::generateRandomHex(),
                        'wallet' => 0
                    );
                    $utilisateur->save($data);
                    Validate::sendValidationMail($data);
                    $array = array("view", "view.php");
                    $view='created';
                    $pagetitle='Utilisateur créée';
                    require (File::build_path($array));
                } else {
                    echo "Mot de passes différent ou adresse mail invalide, veuillez recommencer";
                    $login = $_GET['login'];
                    $nom = $_GET['nom'];
                    $prenom = $_GET['prenom'];
                    $required = "required";
                    $action = "create";
                    $array = array("view", "view.php");
                    $view='update';
                    $pagetitle='Creation d\'un utilisateur';
                    require (File::build_path($array));
                }
        }

        public static function delete() {

        }

        public static function update() {
        
        }

        public static function updated() {

        }

    }

?>