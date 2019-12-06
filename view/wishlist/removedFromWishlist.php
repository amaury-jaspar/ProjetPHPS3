<?php
    echo '<p>The item "' . htmlspecialchars($item->get('name')) . '" has been removed from your wishlist</p>';
    echo '<p><a href="index.php?action=read&controller=wishlist">Do you want to see your wishlist ?</a></p>';
?>
