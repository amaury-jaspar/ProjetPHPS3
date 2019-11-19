<?php

    $userLastname = htmlspecialchars($lastName);

    echo "The user " . $userLastname . " has been deleted";

    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>