<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));
    require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'Session.php')));

class ControllerUser {

    protected static $object = "user";

    public static function read() {
        $login = htmlspecialchars($_GET['login']);
        $user = ModelUser::select($login);
        if ($user == false) {
            $array = array("view", "view.php");
            $view='error';
            $pagetitle='Error page';
            require_once (File::build_path($array));
        } else {
            $array = array("view", "view.php");
            $view='detail';
            $pagetitle='Detail user';
            require_once (File::build_path($array));
        }
    }

public static function readAll() {
        $tab_user = ModelUser::selectAll();
        $array = array("view", "view.php");
        $view='list';
        $pagetitle='Users list';
        require (File::build_path($array));
    }     

    public static function create() {
        $login = "";
        $lastName = "";
        $surname = "";
        $password1 = "";
        $password2 = "";
        $required = "required";
        $action = "created";
        $array = array("view", "view.php");
        $view='update';
        $pagetitle='User\'s creation';
        require (File::build_path($array));
    }

    public static function created() {

        if ($_GET['password1'] == $_GET['password2'] /* && filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL)*/) {
            $user = new ModelUser($_GET['login'], $_GET['lastname'], $_GET['surname'], $_GET['mail'], false, 0);
            $data = array (
                'login' => $_GET['login'],
                'lastName' => $_GET['lastname'],
                'surname' => $_GET['surname'],
                'password' => Security::chiffrer($_GET['password1']),
                'mail' => $_GET['mail'],
                'admin' => 0,
                'nonce' => Security::generateRandomHex(),
                'wallet' => 0,  
            );
            $user->save($data);
            $tab_user = ModelUser::selectAll();
            // Validate::sendValidationMail($data);
            $array = array("view", "view.php");
            $view='created';
            $pagetitle='user created';
            require (File::build_path($array));
        } else {
            echo "The passwords don't match, please retry";
            $login = $_GET['login'];
            $lastName = $_GET['lastname'];
            $surname = $_GET['surname'];
            $required = "required";
            $action = "create";
            $array = array("view", "view.php");
            $view='update';
            $pagetitle='user creation';
            require (File::build_path($array));
        }
    }

    public static function delete() {
        $login = $_GET['login'];
        if ($login == $_SESSION['login'] || Session::is_admin()) {
            ModelUser::deleteById($login);
            $tab_user = ModelUser::selectAll();
            $array = array("view", "view.php");
            $view='deleted';
            $pagetitle='User deleted';
            require (File::build_path($array));
        } else {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connexion';
            require (File::build_path($array));
        }
    }

    /*
    * Seul l'admin ou l'utilisateur en question peuvent faire update sur l'utilisateur
    * On préremplie les champs lastname, surname et mail
    */
	public static function update() {
        if ($_GET['login'] == $_SESSION['login'] || Session::is_admin()) {
            $user = ModelUser::select($_GET['login']);
            $login = rawurlencode($user->getLogin());
			$lastName = rawurlencode($user->getLastName());
			$surname = rawurlencode($user->getSurname());
            $password1 = "";
			$password2 = "";
            $mail = htmlspecialchars($user->getMail());
            $required = "readonly";
			$action = "updated";
			$array = array("view", "view.php");
			$view='update';
			$pagetitle='User modification';
			require (File::build_path($array));
    	} else {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connection';
            require (File::build_path($array));
        }
    }

    /*
    * On vérifie que c'est l'admin ou l'utilisateur en question qui tente de faire updated
    * On ne fait l'udpate que si les 2 mots de passe sont les mêmes
    * 
    */
	public static function updated() {
        if ($_GET['login'] == $_SESSION['login'] || Session::is_admin()) {
            if ($_GET['password1'] == $_GET['password2']) {
            if (isset($_GET['admin']) && $_GET['admin'] == on) { $admin = 1; } else { $admin = 0; }
            $data = array (
				'login' => htmlspecialchars($_GET['login']),
				'lastName' => htmlspecialchars($_GET['lastname']),
				'surname' => htmlspecialchars($_GET['surname']),
				'password' => Security::chiffrer($_GET['password1']),
                'mail' => htmlspecialchars($_GET['mail']),
                'admin' => $admin,
                'nonce' => "",
            );
			ModelUser::updateByID($data);
			$array = array("view", "view.php");
			$view='updated';
			$pagetitle='Modication of a user finished';
			require (File::build_path($array));
		} else {
			echo "The passwords don't match, please retry";
			$login = $_GET['login'];
			$lastName = $_GET['lastname'];
			$surname = $_GET['surname'];
			$mail = $_GET['mail'];
            $required = "required";
			$action = "updated";
			$array = array("view", "view.php");
			$view='update';
			$pagetitle='User\'s creation';
			require (File::build_path($array));
        }
      }  else {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connection';
            require (File::build_path($array));
        }
    }

        public static function connect() {
            $array = array("view", "view.php");
            $view='connect';
            $pagetitle='connection';
            require (File::build_path($array));
        }

        public static function connected() {

//            $checkNonce = ModelUtilisateur::checkNonce($_GET['login']);

            if (ModelUser::checkPassword($_GET['login'], Security::chiffrer($_GET['password'])) /*&& empty($checkNonce['nonce']*/) {
                $_SESSION['login'] = $_GET['login'];
                $user = ModelUser::select($_GET['login']);
                if ($user->getAdmin() == true) {
                    $_SESSION['admin'] = true;
                }
                $array = array("view", "view.php");
                $view='profil';
                $pagetitle='User\'s detail';
                require (File::build_path($array));
            } else {
                echo $_GET['login'];
                echo $_GET['password'];
                echo "Problem, please try again";
                $password = "";
                $login = $_GET['login'];
                $array = array("view", "view.php");
                $view='connect';
                $pagetitle='connection';
                require (File::build_path($array));
            }
        }

        public static function disconnect() {
            unset($_SESSION['login']);
            session_destroy();
            $array = array("view", "view.php");
            $view='disconnected';
            $pagetitle='accueil';
            require (File::build_path($array));
        }

        public function profil() {
            $user = ModelUser::select($_GET['login']);
            if (Session::is_user($user->getLogin())) {
                $array = array("view", "view.php");
                $view='profil';
                $pagetitle='accueil';
                require (File::build_path($array));
            } else {
                $array = array("view", "view.php");
                $view='error';
                $pagetitle='Page d\'erreur';
                require_once (File::build_path($array));
            }
        }

    }

?>