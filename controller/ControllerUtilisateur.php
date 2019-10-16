<?php

    require_once (File::build_path(array('model', 'ModelUtilisateur.php')));
    require_once (File::build_path(array('controller', 'ControllerWishList.php')));
    require_once (File::build_path(array('controller', 'ControllerInventory.php')));
    require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'Session.php')));
    require_once (File::build_path(array('lib', 'Validate.php')));
    // la suite est passé en paramètre car non fonctionnel actuellement
//    require_once (File::build_path(array('lib', 'Wallet.php')));

    class ControllerUtilisateur {

        protected static $object = "utilisateur";

        public static function read() {
            $login = htmlspecialchars($_GET['login']);
            $utilisateur = ModelUtilisateur::select($login);
            if ($utilisateur == false) {
                $array = array("view", "view.php");
                $view='error';
                $pagetitle='Page d\'erreur';
                require_once (File::build_path($array));
            } else {
                $array = array("view", "view.php");
                $view='detail';
                $pagetitle='Detail d\'un utilisateur';
                require_once (File::build_path($array));
            }
        }

        public static function readAll() {
            $tab_utilisateur = ModelUtilisateur::selectAll();
            $array = array("view", "view.php");
            $view='list';
            $pagetitle='Liste des utilisateurs';
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
            $pagetitle='Creation d\'un utilisateur';
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
            $login = $_GET['login'];
            if ($login == $_SESSION['login'] || Session::is_admin()) {
            ModelUtilisateur::deleteById($login);
            $tab_utilisateur = ModelUtilisateur::selectAll();
            $array = array("view", "view.php");
            $view='deleted';
            $pagetitle='Utilisateur supprimée';
            require (File::build_path($array));
        } else {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connection';
            require (File::build_path($array));
        }
    }

        public static function update() {
            $login = $_GET['login'];
            if ($login == $_SESSION['login'] || Session::is_admin()) {
                $utilisateur = ModelUtilisateur::select($login);
                $nom = rawurlencode($utilisateur->getNom());
                $prenom = rawurlencode($utilisateur->getPrenom());
                $password1 = "";
                $password2 = "";
                $required = "readonly";
                $action = "updated";
                $array = array("view", "view.php");
                $view='update';
                $pagetitle='Modification d\'utilisateur';
                require (File::build_path($array));
            } else {
                $array = array("view", "view.php");
                $view='connect';
                $pagetitle='connection';
                require (File::build_path($array));
            }

        }

        public static function updated() {
            $login = $_GET['login'];
            if ($login == $_SESSION['login'] || Session::is_admin()) {
            if ($_GET['password1'] == $_GET['password2']) {
                if (isset($_GET['admin']) && $_GET['admin'] == on) {
                    $admin = 1;
                } else {
                    $admin = 2;
                }
                $data = array (
                    'login' => $_GET['login'],
                    'nom' => $_GET['nom'],
                    'prenom' => $_GET['prenom'],
                    'password' => Security::chiffrer($_GET['password1']),
                    'admin' => $admin
                );
                ModelUtilisateur::updateByID($data);
                $array = array("view", "view.php");
                $view='updated';
                $pagetitle='Modification d\'utilisateur terminée';
                require (File::build_path($array));
            } else {
                echo "Mot de passes différent, veuillez recommencer";
                $login = $_GET['login'];
                $nom = $_GET['nom'];
                $prenom = $_GET['prenom'];
                $required = "required";
                $action = "updated";
                $array = array("view", "view.php");
                $view='update';
                $pagetitle='Creation d\'un utilisateur';
                require (File::build_path($array));
                }
            } else {
                $array = array("view", "view.php");
                $view='connect';
                $pagetitle='connection';
                require (File::build_path($array));
            }
        }

//----------------------------------- VALIDATION COMPTE --------------------------------------------------------------------------------------
 
        // La partie d'adresse mail qui fonctionne quand on veut faire appel à validation
        // index.php?controller=utilisateur&action=validation&login=1234&nonce=9fa4ab1932b878bdaadb3b0d3cd73bea        
        public static function validation() {
            // On valide en effaçant le nonce dans la BD
            Validate::validation();
            // Maintenant, on veut créer un inventaire et une WishList à l'utilisateur en plaçant sont login dans les BD
            ControllerWishList::addUser($_GET['login']);
            ControllerInventory::addUser($_GET['login']);
            $array = array("view", "view.php");
            $view='validated';
            $pagetitle='Validation';
            require (File::build_path($array));
        }

//-----------------------------------PROFIL--------------------------------------------------------------------------------------

        public function pageBuilder() {
            $utilisateur = ModelUtilisateur::select($_SESSION['login']);
            $array = array("view", "view.php");
            $view='profil';
            $pagetitle='Votre compte';
            require (File::build_path($array));

            // On récupère toutes les données de l'utilisateur et on les expose, tout en proposant de les modifier
            // On fait alors appel à des getters, puis à des setters pour modifier l'objet courant
            // Puis tout en bas, on modifie la base de donnée à l'aide d'une fonction save, qui surtout, fait un update de l'utilisateur
        }

//-----------------------------------LISTE DE SOUHAIT--------------------------------------------------------------------------------------

            // Pour stocker en dur ce qu'un utilisateur veut acheter étant donné que le panier disparait après un moment
        public function addToWishList() {
            // On a une liste de produit qui va perdurer dans le temps, 
        }

//-----------------------------------PREFERENCE--------------------------------------------------------------------------------------        

        public static function preference() {
            $array = array("view", "view.php");
            $view='preference';
            $pagetitle='préférence';
            require (File::build_path($array));
        }

//---------------------------------PORTE-MONNAIE----------------------------------------------------------------------------------------


//---------------------------------------CONNECTION----------------------------------------------------------------------------------

        public static function connect() {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connection';
            require (File::build_path($array));
        }

        public static function connected() {

            $checkNonce = ModelUtilisateur::checkNonce($_GET['login']);

            if (ModelUtilisateur::checkPassword($_GET['login'], Security::chiffrer($_GET['password'])) && empty($checkNonce['nonce'])) {
                $_SESSION['login'] = $_GET['login'];
                $utilisateur = ModelUtilisateur::select($_GET['login']);
                if ($utilisateur->getAdmin() == true) {
                    $_SESSION['admin'] = true;
                }
                $array = array("view", "view.php");
                $view='detail';
                $pagetitle='Detail de l\'utilisateur';
                require (File::build_path($array));
            } else {
                echo $_GET['login'];
                echo $_GET['password'];
                echo "Problème, veuillez réessayer";
                $password = "";
                $login = $_GET['login'];
                $array = array("view", "view.php");
                $view='connect';
                $pagetitle='connection';
                require (File::build_path($array));
            }
        }

            // Détruit la session de l'utilisateur
        public static function disconnect() {
            unset($_SESSION['login']);
            session_destroy();
            $array = array("view", "view.php");
            $view='disconnected';
            $pagetitle='accueil';
            require (File::build_path($array));
        }

        
    }

?>