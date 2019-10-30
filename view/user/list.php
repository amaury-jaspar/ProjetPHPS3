<?php

foreach ($tab_user as $user)

    echo '<p> User : <a href="index.php?controller=user&action=read&login=' . rawurlencode($user->getLogin()) . ' "> ' . rawurlencode($user->getLastName()) . ' </a></p>';

    echo '<a href="index.php?controller=user&action=create">Create a new user</a>';

?>
