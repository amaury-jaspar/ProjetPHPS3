<?php
class Session {

    public static function is_user($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }

    public static function is_admin() {
        return (!empty($_SESSION['admin']) && $_SESSION['admin']);
    }

    public static function is_connected() {
        return (isset($_SESSION['connected']) && $_SESSION['connected'] == true);
    }

    public static function different_user() {
        Messenger::alert("due to technical error, we need to ask you to log again");
        unset($_SESSION['login']);
        session_destroy();
        setcookie(session_name(),'',time()-1/*, "/~simondonj/ecommerce/", "webinfo.iutmontp.univ-montp2.fr"*/);
    }
    
}
?>