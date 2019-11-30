<?php

$categoryName = htmlspecialchars($category->get('name'));
$categoryDescription = htmlspecialchars($category->get('description'));

$nameURL = rawurlencode($category->get('name'));

echo '<div>Name : '.$categoryName.'</div> Description : '.$categoryDescription.'</div>';

echo '<br>';

if (Session::is_admin()) {
    echo '<a href="index.php?controller=category&action=delete&name=' .$nameURL . ' ">Delete this category from DataBase</a>';
    echo '<br>';
    echo '<a href="index.php?controller=category&action=update&name=' . $nameURL . ' ">Modify the data of this category</a>';
    echo '<br>';
}

?>
