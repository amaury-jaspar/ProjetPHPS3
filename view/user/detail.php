<?php

$userLogin = htmlspecialchars($user->get('login'));
$userLastname = htmlspecialchars($user->get('lastName'));
$userName = htmlspecialchars($user->get('surname'));
$userMail = htmlspecialchars($user->get('mail'));
$userAdmin = htmlspecialchars($user->get('admin'));
$userIdURL = rawurlencode($user->get('login'));


    echo "<div>login : " . $userLogin."</div>";
    echo "<div>last name : " . $userLastname."</div>";
    echo "<div>surname : " . $userName."</div>";
    echo "<div>mail : " . $userMail."</div>";
    echo "<div>is admin ? : " . $userAdmin."</div>";


    if (Session::is_user($user->get('login'))  || Session::is_admin()) {
        echo '<div><a href="index.php?controller=user&action=delete&login=' . $userIdURL . ' ">Delete this user from DataBase</a></div>';
        echo '<div><a href="index.php?controller=user&action=update&login=' . $userIdURL . ' ">Modificate the data of this user</a></div>';
    }

?>
