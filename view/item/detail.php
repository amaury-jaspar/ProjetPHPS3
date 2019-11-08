<?php

$htmlname = htmlspecialchars($item->getName());
$htmlPrice = htmlspecialchars($item->getPrice());
$htmlDescription = htmlspecialchars($item->getDescription());

$urlID = rawurlencode($item->getID());

echo '<div>Name : '.$htmlname.'</div> <div>Price : '.$htmlPrice.'</div> Description '.$htmlDescription.'</div>';

echo '<br>';

if (Session::is_admin()) {
    echo '<a href="index.php?controller=item&action=delete&id=' . rawurlencode($item->getId()) . ' ">Delete this item from DataBase</a>';
    echo '<br>';
    echo '<a href="index.php?controller=item&action=update&id=' . rawurlencode($item->getId()) . ' ">Modificate the data of this item</a>';
    echo '<br>';
}


?>