<?php

    echo "<p>the category " . htmlspecialchars($name) . " has been deleted</p>";

    $array = array("view", "category", "list.php");
    require (File::build_path($array));

?>