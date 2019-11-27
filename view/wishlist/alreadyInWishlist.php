<?php
    print_r($current_wishlist);
    echo 'The item ' . htmlspecialchars(Routeur::myGet('name')) . ' is already in your wishlist ';
    echo "<br>";
    echo '<a href="index.php?action=read&controller=wishlist">Do you want to see your wishlist ?</a>';
?>
