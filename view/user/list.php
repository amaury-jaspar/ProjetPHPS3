<?php

foreach ($tab_user as $user) {

    $userLogin = rawurldecode($user->get('login'));
    $userLastName = htmlspecialchars($user->get('lastName'));

    echo '<p> User : <a href="index.php?controller=user&action=read&login=' . $userLogin . ' "> ' . $userLastName . ' </a></p>';

}
    echo '<p><a href="index.php?controller=user&action=create">Create a new user</a></p>';

?>
