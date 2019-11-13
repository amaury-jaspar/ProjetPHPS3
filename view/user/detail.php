<?php

$userLogin = $user->getLogin();
$userLastname = $user->getLastName();
$userName = $user->getSurname();
$userMail = $user->getMail();
$userAdmin = $user->getAdmin();

    echo "login : " . $userLogin;
    echo '<br>';
    echo "last name : " . $userLastname;
    echo '<br>';
    echo "surname : " . $userName;
    echo '<br>';
    echo "mail : " . $userMail;
    echo '<br>';
    echo "is admin ? : " . $userAdmin;
    echo '<br>';

    if ($_SESSION['login'] == $user->getLogin() || Session::is_admin()) {
        echo '<a href="index.php?controller=user&action=delete&login=' . rawurlencode($user->getLogin()) . ' ">Delete this user from DataBase</a>';
        echo '<br>';
        echo '<a href="index.php?controller=user&action=update&login=' . rawurlencode($user->getLogin()) . ' ">Modificate the data of this user</a>';
        echo '<br>';
    }

?>
