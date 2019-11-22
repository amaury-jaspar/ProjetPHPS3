<?php

    $categoryName = htmlspecialchars($category->get('name'));

    echo 'The item ' . $categoryName . ' has been added to the basket ';
    echo "<br>";
    echo '<a href="index.php?action=readBasket&controller=item">Do you want to see your basket ?</a>';
    echo "<br>";
    echo '<a href="index.php?action=paging&controller=item">Do you want to continue your buy ?</a>';

?>