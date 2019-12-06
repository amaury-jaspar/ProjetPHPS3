<?php

    echo "the item " . htmlspecialchars($name) . " has been deleted";
    
    require (File::build_path(array("view", "item", "list.php")));

?>