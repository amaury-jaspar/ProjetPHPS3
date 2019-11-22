<?php

    $categoryName = Routeur::myGet('name');

    echo "the item " . $categoryName . " has been updated !</p>";

    $array = array("view", "category", "list.php");
    require (File::build_path($array));

?>