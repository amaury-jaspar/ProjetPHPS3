<?php

    $lastName = htmlspecialchars($user->getLastName());
    $surname = htmlspecialchars($user->getSurname());
    
    echo $lastName . " " . $surname . " have been created and saved";

    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>