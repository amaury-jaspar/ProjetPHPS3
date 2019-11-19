<?php

    $userLastName = htmlspecialchars($_GET['lastname']);
    $userSurname = htmlspecialchars($_GET['surname']);

    echo $userLastName . " " . $userSurname . " has been modified !</p>";

    $tab_user = ModelUser::selectAll();
    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>