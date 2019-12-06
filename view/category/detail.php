<?php

$categoryName = htmlspecialchars($category->get('name'));
$categoryDescription = htmlspecialchars($category->get('description'));
$nameURL = rawurlencode($category->get('name'));

echo "<p>Name : $categoryName</p>";
echo "<p>Description : $categoryDescription</p>";

if (Session::is_admin()) {
    echo '<p><a href="index.php?controller=category&action=delete&name=' .$nameURL . ' ">Delete this category from DataBase</a></p>';
    echo '<p><a href="index.php?controller=category&action=update&name=' . $nameURL . ' ">Modify the data of this category</a></p>';
}

?>
