<?php

    echo $_GET['lastname'] . " " . $_GET['surname'] . " has been modified !</p>";

    $tab_user = ModelUser::selectAll();
    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>