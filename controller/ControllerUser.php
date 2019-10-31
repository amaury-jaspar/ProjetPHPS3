<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));
    require_once (File::build_path(array('lib', 'Security.php')));

	class ControllerUser {

		protected static $object = "user";

        public static function read() {
            $login = htmlspecialchars($_GET['login']);
            $user = ModelUser::select($login);
            if ($user == false) {
                $array = array("view", "view.php");
                $view='error';
                $pagetitle='Page d\'erreur';
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
            if ($_GET['password1'] == $_GET['password2']) {
                $user = new ModelUser($_GET['login'], $_GET['lastname'], $_GET['surname'], $_GET['mail']);
                $data = array (
                    'login' => $user->getLogin(),
                    'lastName' => $user->getLastName(),
                    'surname' => $user->getSurname(),
                    'password' => Security::chiffrer($_GET['password1']),
                    'mail' => $_GET['mail']
                );
                $user->save($data);
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
            ModelUser::deleteById($login);
            $tab_user = ModelUser::selectAll();
            $array = array("view", "view.php");
            $view='deleted';
            $pagetitle='User deleted';
            require (File::build_path($array));
    }

	public static function update() {
		$login = $_GET['login'];
			$user = ModelUser::select($login);
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
	}

	public static function updated() {
		$login = $_GET['login'];
		if ($_GET['password1'] == $_GET['password2']) {
			$data = array (
				'login' => $_GET['login'],
				'lastName' => $_GET['lastname'],
				'surname' => $_GET['surname'],
				'password' => Security::chiffrer($_GET['password1']),
                'mail' => $_GET['mail']
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
			$required = "required";
			$action = "updated";
			$array = array("view", "view.php");
			$view='update';
			$pagetitle='User\'s creation';
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

            if (ModelUser::checkPassword($_GET['login'], Security::chiffrer($_GET['password']))) {
                $_SESSION['login'] = $_GET['login'];
                $user = ModelUser::select($_GET['login']);
                $array = array("view", "view.php");
                $view='profil';
                $pagetitle='User\'s detail';
                require (File::build_path($array));
            } else {
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