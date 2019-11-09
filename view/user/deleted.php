<?php

    echo "The user " . htmlspecialchars($lastName) . " has been deleted";

    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>