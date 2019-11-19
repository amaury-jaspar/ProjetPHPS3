<?php

    $itemName = $_GET['name'];

    echo "the item " . $itemName . " has been updated !</p>";

    $array = array("view", "item", "list.php");
    require (File::build_path($array));

?>