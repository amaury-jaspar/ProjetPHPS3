<?php

foreach ($tab_user as $user) {

    $userLogin = rawurldecode($user->get('login'));
    $userLastName = htmlspecialchars($user->get('lastName'));

    if (Session::is_admin() || Session::is_user($userLogin)) {
    echo '<p> User : <a href="index.php?controller=user&action=read&login=' . $userLogin . ' "> ' . $userLastName . ' </a></p>';
    }

}

    if (Session::is_admin()) {
        echo '<a href="index.php?controller=user&action=create">Create a new user</a>';
    }

?>
