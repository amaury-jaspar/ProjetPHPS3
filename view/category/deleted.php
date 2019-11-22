<?php

    echo "the category " . htmlspecialchars($name) . " has been deleted";

    $array = array("view", "category", "list.php");
    require (File::build_path($array));

?>