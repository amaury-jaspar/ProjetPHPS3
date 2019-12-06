<?php

    echo '<div>The item ' . htmlspecialchars($item->get('name')) . ' has been removed to the basket</div>';
    echo '<div><a href="index.php?action=readBasket&controller=basket">Basket</a></div>';

?>