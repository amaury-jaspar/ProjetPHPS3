<?php

    echo $user->getLastName() . " " . $user->getSurname() . " have been created and saved";

    $tab_user = ModelUser::selectAll();
    $array = array("view", "user", "list.php");
    require (File::build_path($array));

?>