<?php

    $itemName = Routeur::myGet('name');

    echo "the item " . $itemName . " has been updated !</p>";

    $array = array("view", "item", "list.php");
    require (File::build_path($array));

?>