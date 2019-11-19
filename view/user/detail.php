<?php

$userLogin = htmlspecialchars($user->get('login'));
$userLastname = htmlspecialchars($user->get('lastName'));
$userName = htmlspecialchars($user->get('surname'));
$userMail = htmlspecialchars($user->get('mail'));
$userAdmin = htmlspecialchars($user->get('admin'));
$userIdURL = rawurlencode($user->getLogin());

    echo "login : " . $userLogin;
    echo '<br>';
    echo "last name : " . $userLastname;
    echo '<br>';
    echo "surname : " . $userName;
    echo '<br>';
    echo "mail : " . $userMail;
    echo '<br>';
    echo "is admin ? : " . $userAdmin;


    if (Session::is_user($user->get('login'))  || Session::is_admin()) {
        echo '<br>';
        echo '<a href="index.php?controller=user&action=delete&login=' . $userIdURL . ' ">Delete this user from DataBase</a>';
        echo '<br>';
        echo '<a href="index.php?controller=user&action=update&login=' . $userIdURL . ' ">Modificate the data of this user</a>';
    }

?>
