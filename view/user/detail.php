<?php

$userLogin = htmlspecialchars($user->get('login'));
$userLastname = htmlspecialchars($user->get('lastName'));
$userName = htmlspecialchars($user->get('surname'));
$userMail = htmlspecialchars($user->get('mail'));
$userAdmin = htmlspecialchars($user->get('admin'));


    echo "login : " . $userLogin;
    echo '<br>';
    echo "last name : " . $userLastname;
    echo '<br>';
    echo "surname : " . $userName;
    echo '<br>';
    echo "mail : " . $userMail;
    echo '<br>';
    echo "is admin ? : " . $userAdmin;


    if ($_SESSION['login'] == $user->get('login') || Session::is_admin()) {
        echo '<br>';
        echo '<a href="index.php?controller=user&action=delete&login=' . rawurlencode($user->getLogin()) . ' ">Delete this user from DataBase</a>';
        echo '<br>';
        echo '<a href="index.php?controller=user&action=update&login=' . rawurlencode($user->getLogin()) . ' ">Modificate the data of this user</a>';
    }

?>
