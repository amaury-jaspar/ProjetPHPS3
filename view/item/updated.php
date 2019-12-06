<?php

    echo "<p>the item " . htmlspecialchars(myGet('name')) . " has been updated !</p>";
    
    require (File::build_path(array("view", "item", "list.php")));

?>