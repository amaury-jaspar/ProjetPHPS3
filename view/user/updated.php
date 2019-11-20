<?php

    $userLastName = htmlspecialchars(Routeur::myGet('lastname'));
    $userSurname = htmlspecialchars(Routeur::myGet('surname'));

    echo $userLastName . " " . $userSurname . " has been modified !</p>";

    $tab_user = ModelUser::selectAll();
    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>