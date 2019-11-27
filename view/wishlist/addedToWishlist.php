<?php
    $item = ModelItem::select(Routeur::myGet('id'));
    echo 'The item "' . htmlspecialchars($item->get('name')) . '" has been added to the wishlist ';
    echo "<br>";
    echo '<a href="index.php?action=read&controller=wishlist">Do you want to see your wishlist ?</a>';
?>
