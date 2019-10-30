<?php

    echo "The user " . $lastName . " has been deleted";

    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>