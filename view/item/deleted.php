<?php

    echo "the item " . htmlspecialchars($name) . " has been deleted";

    $array = array("view", "item", "list.php");
    require (File::build_path($array));

?>