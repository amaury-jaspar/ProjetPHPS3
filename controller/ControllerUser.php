<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));
    require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'Session.php')));

class ControllerUser {

    protected static $object = "user";

    public static function read() {
        $login = $_GET['login'];
        $user = ModelUser::select($login);
        if ($user == false) {
            $view='error';
            $pagetitle='Error page';
            require_once (File::build_path(array("view", "view.php")));
        } else {
            $view='detail';
            $pagetitle='Detail user';
            require_once (File::build_path(array("view", "view.php")));
        }
    }

    public static function readAll() {
        $tab_user = ModelUser::selectAll();
        $view='list';
        $pagetitle='Users list';
        require (File::build_path(array("view", "view.php")));
    }     

    public static function create() {
        $login = "";
        $lastName = "";
        $surname = "";
        $password1 = "";
        $password2 = "";
        $required = "required";
        $action = "created";
        $view='update';
        $pagetitle='User\'s creation';
        require (File::build_path(array("view", "view.php")));
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
            $view='created';
            $pagetitle='user created';
            require (File::build_path(array("view", "view.php")));
        } else {
            echo "The passwords don't match, please retry";
            $login = $_GET['login'];
            $lastName = $_GET['lastname'];
            $surname = $_GET['surname'];
            $required = "required";
            $action = "create";
            $view='update';
            $pagetitle='user creation';
            require (File::build_path(array("view", "view.php")));
        }
    }

    public static function delete() {
        $login = $_GET['login'];
        if ($login == $_SESSION['login'] || Session::is_admin()) {
            $view='delete';
            $pagetitle='Delete validation';
            require (File::build_path(array("view", "view.php")));
        } else {
            $view='connect';
            $pagetitle='connexion';
            require (File::build_path(array("view", "view.php")));
        }
    }


    public static function deleted() {
        $login = $_GET['login'];
        if ($login == $_SESSION['login'] || Session::is_admin()) {
            ModelUser::deleteById($login);
            $tab_user = ModelUser::selectAll();
            $view='deleted';
            $pagetitle='Delete validation';
            require (File::build_path(array("view", "view.php")));
        } else {
            $view='connect';
            $pagetitle='connexion';
            require (File::build_path(array("view", "view.php")));
        }
    }

    /*
    * Seul l'admin ou l'utilisateur en question peuvent faire update sur l'utilisateur
    * On préremplie les champs lastname, surname et mail
    */
	public static function update() {
        if ($_GET['login'] == $_SESSION['login'] || Session::is_admin()) {
            $user = ModelUser::select($_GET['login']);
            $login = htmlspecialchars($user->get('login'));
            $lastName = htmlspecialchars($user->get('lastName'));
            $surname = htmlspecialchars($user->get('surname'));
            $mail = htmlspecialchars($user->get('mail'));
            $password = "";
            $password = "";            
            $required = "readonly";
			$action = "updated";
			$view='update';
			$pagetitle='User modification';
			require (File::build_path(array("view", "view.php")));
    	} else {
            $view='connect';
            $pagetitle='connection';
            require (File::build_path(array("view", "view.php")));
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
			$view='updated';
			$pagetitle='Modication of a user finished';
			require (File::build_path(array("view", "view.php")));
		} else {
			echo "The passwords don't match, please retry";
			$login = $_GET['login'];
			$lastName = $_GET['lastname'];
			$surname = $_GET['surname'];
			$mail = $_GET['mail'];
            $required = "required";
			$action = "updated";
			$view='update';
			$pagetitle='User\'s creation';
			require (File::build_path(array("view", "view.php")));
        }
      }  else {
            $view='connect';
            $pagetitle='connection';
            require (File::build_path(array("view", "view.php")));
        }
    }

        public static function connect() {
            $view='connect';
            $pagetitle='connection';
            require (File::build_path(array("view", "view.php")));
        }

        public static function connected() {

//            $checkNonce = ModelUtilisateur::checkNonce($_GET['login']);
            if (ModelUser::checkPassword($_GET['login'], Security::chiffrer($_GET['password'])) /*&& empty($checkNonce['nonce']*/) {
                $_SESSION['login'] = $_GET['login'];
                $user = ModelUser::select($_GET['login']);
                if ($user->get('admin') == true) {
                    $_SESSION['admin'] = true;
                }
                $view='profil';
                $pagetitle='User\'s detail';
                require (File::build_path(array("view", "view.php")));
            } else {
                echo $_GET['login'];
                echo $_GET['password'];
                echo "Problem, please try again";
                $password = "";
                $login = $_GET['login'];
                $view='connect';
                $pagetitle='connection';
                require (File::build_path(array("view", "view.php")));
            }
        }

        public static function disconnect() {
            unset($_SESSION['login']);
            session_destroy();
            $view='disconnected';
            $pagetitle='accueil';
            require (File::build_path(array("view", "view.php")));
        }

        public function profil() {
            $user = ModelUser::select($_GET['login']);
            if (Session::is_user($user->getLogin())) {
                $view='profil';
                $pagetitle='accueil';
                require (File::build_path(array("view", "view.php")));
            } else {
                $view='error';
                $pagetitle='Page d\'erreur';
                require_once (File::build_path(array("view", "view.php")));
            }
        }

    }

?>