<?php

    $preference = $_GET['preference'];
    setcookie("preference", $preference, time()+3600);

    require ('index.php');


?>