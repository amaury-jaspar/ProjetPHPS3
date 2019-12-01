<?php
    echo 'The item "' . htmlspecialchars($item->get('name')) . '" is already in your wishlist ';
    echo "<br>";
    echo '<a href="index.php?action=read&controller=wishlist">Do you want to see your wishlist ?</a>';
?>
