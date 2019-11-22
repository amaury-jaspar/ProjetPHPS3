<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));
    require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'Session.php')));
    require_once (File::build_path(array('lib', 'Validate.php')));

class ControllerUser {

    protected static $object = "user";

    public static function read() {
        $login = Routeur::myGet('login');
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
        if (Session::is_admin()) {
            $tab_user = ModelUser::selectAll();
            $view='list';
            $pagetitle='Users list';
            require (File::build_path(array("view", "view.php")));
        } else {
            $view='error';
            $pagetitle='Error page';
            require_once (File::build_path(array("view", "view.php")));
        }
    }

    public static function create() {
        $login = "";
        $lastName = "";
        $surname = "";
        $password1 = "";
        $password2 = "";
        $mail = "";
        $required = "required";
        $action = "created";
        $view='update';
        $pagetitle='User\'s creation';
        require (File::build_path(array("view", "view.php")));
    }

    public static function created() {
        if (Routeur::myGet('password1') == Routeur::myGet('password2') && filter_var(Routeur::myGet('mail'), FILTER_VALIDATE_EMAIL)) {
            $data = array (
                'login' => Routeur::myGet('login'),
                'lastName' => Routeur::myGet('lastname'),
                'surname' => Routeur::myGet('surname'),
                'password' => Security::chiffrer(Routeur::myGet('password1')),
                'mail' => Routeur::myGet('mail'),
                'admin' => 0,
                'nonce' => Security::generateRandomHex(),
                'wallet' => 0,
                'level' => 0,
                'spend' => 0
            );
            $user = new ModelUser($data);
            $user->save($data);
            $tab_user = ModelUser::selectAll();
            Validate::sendValidationMail($data);
            $view='created';
            $pagetitle='user created';
            require (File::build_path(array("view", "view.php")));
        } else {
            echo "The passwords don't match, please retry";
            $login = Routeur::myGet('login');
            $lastName = Routeur::myGet('lastname');
            $surname = Routeur::myGet('surname');
            $required = "required";
            $action = "create";
            $view='update';
            $pagetitle='user creation';
            require (File::build_path(array("view", "view.php")));
        }
    }

    public static function delete() {
        $login = Routeur::myGet('login');
        if (Session::is_user(Routeur::myGet('login')) || Session::is_admin()) {
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
        $login = Routeur::myGet('login');
        if (Session::is_user(Routeur::myGet('login')) || Session::is_admin()) {
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
        if (Session::is_user(Routeur::myGet('login')) || Session::is_admin()) {
            $user = ModelUser::select(Routeur::myGet('login'));
            $login = htmlspecialchars($user->get('login'));
            $lastName = htmlspecialchars($user->get('lastName'));
            $surname = htmlspecialchars($user->get('surname'));
            $mail = htmlspecialchars($user->get('mail'));
            $admin = htmlspecialchars($user->get('admin'));
            $password1 = "";
            $password2 = "";
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
        if (Session::is_user(Routeur::myGet('login')) || Session::is_admin()) {
            if (Routeur::myGet('password1') == Routeur::myGet('password2')) {
            if (Routeur::myGet('admin') !== NULL && Routeur::myGet('admin') == on) { $admin = 1; } else { $admin = 0; }
            $data = array (
				'login' => htmlspecialchars(Routeur::myGet('login')),
				'lastName' => htmlspecialchars(Routeur::myGet('lastname')),
				'surname' => htmlspecialchars(Routeur::myGet('surname')),
				'password' => Security::chiffrer(Routeur::myGet('password1')),
                'mail' => htmlspecialchars(Routeur::myGet('mail')),
                'admin' => htmlspecialchars(Routeur::myGet('admin')),
                'nonce' => NULL,
                'level' => htmlspecialchars(Routeur::myGet('level')),
                'spend' => htmlspecialchars(Routeur::myGet('spend')),
            );
			ModelUser::updateByID($data);
			$view='updated';
			$pagetitle='Modication of a user finished';
			require (File::build_path(array("view", "view.php")));
		} else {
			echo "The passwords don't match, please retry";
			$login = Routeur::myGet('login');
			$lastName = Routeur::myGet('lastname');
			$surname = Routeur::myGet('surname');
			$mail = Routeur::myGet('mail');
            $required = "required";
			$action = "updated";
			$view = 'update';
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
        if (ModelUser::checkPassword(Routeur::myGet('login'), Security::chiffrer(Routeur::myGet('password'))) && ModelUser::checkNonce(Routeur::myGet('login'))) {
            $_SESSION['login'] = Routeur::myGet('login');
            $user = ModelUser::select(Routeur::myGet('login'));
            if ($user->get('admin') == true) {
                $_SESSION['admin'] = true;
            }
            $view='profil';
            $pagetitle='User\'s detail';
            require (File::build_path(array("view", "view.php")));
        } else {
            echo "Problem, please try again";
            $password = "";
            $login = Routeur::myGet('login');
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
        $user = ModelUser::select(Routeur::myGet('login'));
        if (Session::is_user($user->get('login'))) {
            $view='profil';
            $pagetitle='accueil';
            require (File::build_path(array("view", "view.php")));
        } else {
            $view='error';
            $pagetitle='Page d\'erreur';
            require_once (File::build_path(array("view", "view.php")));
        }
    }

/*
    public function payBill() {
        echo 'paybill';
        ModelUser::substractMoney();
    }
*/

    public function saveCurrentState($data) {
        echo 'passe ici';
        ModelUser::updateByID($this);
    }

    public function checkLevel() {
        if ($this->depense >= 0 && $this->depense < 100) {
            $level = 1;
            echo "Felicitation, vous êtes monté de niveau";
        } else if ($this->depense >= 100 && $this->depense < 1000) {
            $level = 2;
            echo "Felicitation, vous êtes monté de niveau";
        } else if ($this->depense >= 1000 && $this->depense < 10000) {
            $level = 3;
            echo "Felicitation, vous êtes monté de niveau";
        } else if ($this->depense >= 100000 && $this->depense < 1000000) {
            $level = 4;
            echo "Felicitation, vous êtes monté de niveau";
        } else if ($this->depense >= 1000000 && $this->depense < 10000000) {
            $level = 5;
        }
        $this->set('level', $level);
        $this->saveCurrentState($this);
    }

//----------------------------------- VALIDATION COMPTE --------------------------------------------------------------------------------------

    public static function validation() {
        Validate::validation();
        $view='profil';
        $pagetitle='profile';
        require (File::build_path(array("view", "view.php")));
    }

}

?>
