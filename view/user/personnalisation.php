<?php

    $preference = htmlspecialchars(Routeur::myGet('preference'));

    setcookie("preference", $preference, time()+3600);

    require ('index.php');

?>