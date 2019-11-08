<?php

    echo "the item " . $_GET['name'] . " has been updated !</p>";

    $array = array("view", "item", "list.php");
    require (File::build_path($array));

?>