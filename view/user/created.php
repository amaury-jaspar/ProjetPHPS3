<?php

    $userLastName = htmlspecialchars($user->get('lastName'));
    $userSurname = htmlspecialchars($user->get('surname'));
    
    echo "$userSurname $userLastName has been created and saved";

    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>