<?php

    echo "login : " . $user->getLogin();
    echo '<br>';
    echo "last name : " . $user->getLastName();
    echo '<br>';
    echo "surname : " . $user->getSurname();
    echo '<br>';
    echo "mail : " . $user->getMail();
    echo '<br>';
    echo '<a href="index.php?controller=user&action=delete&login=' . rawurlencode($user->getLogin()) . ' ">Delete this user from DataBase</a>';
    echo '<br>';
    echo '<a href="index.php?controller=user&action=update&login=' . rawurlencode($user->getLogin()) . ' ">Modificate the data of this user</a>';
    echo '<br>';

?>
