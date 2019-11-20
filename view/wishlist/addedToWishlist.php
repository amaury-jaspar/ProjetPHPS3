<?php

    echo 'The item ' . htmlspecialchars(Routeur::myGet('id')) . ' has been added to the wishlist ';
    echo "<br>";
    echo '<a href="index.php?action=read&controller=wishlist">Do you want to see your wishlist ?</a>';

?>
