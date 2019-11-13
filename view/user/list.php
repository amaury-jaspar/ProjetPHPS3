<?php

foreach ($tab_user as $user)

    $login = rawurldecode($user->get('login'));
    $lastName = htmlspecialchars($user->get('lastName'));

    echo '<p> User : <a href="index.php?controller=user&action=read&login=' . $login . ' "> ' . $lastName . ' </a></p>';

    echo '<a href="index.php?controller=user&action=create">Create a new user</a>';

?>
