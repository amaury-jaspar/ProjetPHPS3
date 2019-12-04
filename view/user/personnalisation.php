<?php

    $preference = htmlspecialchars(myGet('preference'));

    setcookie("preference", $preference, time()+3600);

    require ('index.php');

?>