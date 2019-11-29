<?php

    $itemName = htmlspecialchars($item->get('name'));

    echo 'The item ' . $itemName . ' has been removed to the basket ';
    echo "<br>";
    echo '<a href="index.php?action=readBasket&controller=basket">Basket</a></li>';
?>