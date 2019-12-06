<?php

    echo "<p>the category " . htmlspecialchars(myGet('name')) . " has been updated !</p>";
    
    require (File::build_path(array("view", "category", "list.php")));

?>