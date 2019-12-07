<?php

    echo "The command " . htmlspecialchars($id) . " has been deleted";
    
    require (File::build_path(array("view", "command", "list.php")));

?>
