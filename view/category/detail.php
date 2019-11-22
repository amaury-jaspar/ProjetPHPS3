<?php

$categoryName = htmlspecialchars($category->get('name'));
$categoryDescription = htmlspecialchars($category->get('description'));

$idURL = rawurlencode($category->get('id'));


echo '<div>Name : '.$categoryName.'</div> Description '.$categoryDescription.'</div>';

echo '<br>';

if (Session::is_admin()) {
    echo '<a href="index.php?controller=category&action=delete&id=' .$idURL . ' ">Delete this category from DataBase</a>';
    echo '<br>';
    echo '<a href="index.php?controller=category&action=update&id=' . $idURL . ' ">Modificate the data of this category</a>';
    echo '<br>';
}

echo '<a href="index.php?controller=category&action=addToBasket&prix='. $priceURL .'&id=' . $idURL . ' ">Add to basket</a>';

?>