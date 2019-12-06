<?php

$itemName = htmlspecialchars($item->get('name'));
$itemPrice = htmlspecialchars($item->get('price'));
$itemDescription = htmlspecialchars($item->get('description'));

$idURL = rawurlencode($item->get('id'));
$priceURL = rawurlencode($item->get('price'));


echo <<< EOT
<p>Name : $itemName</p>
<p>Price : $itemPrice</p>
<p>Description : $itemDescription</p>
<div><img class="responsive-img" width="200" height="200" src="../images/$itemName.jpg" alt=""><div>

EOT;
if (Session::is_admin()) {
echo <<< EOT

<p><a href="index.php?controller=item&action=delete&id=$idURL">Delete this item from DataBase</a></p>
<p><a href="index.php?controller=item&action=update&id=$idURL">Modify the data of this item</a></p>
   
EOT;
}
echo <<< EOT

<p><a href="index.php?controller=basket&action=addToBasket&id=$idURL">Add to basket</a><p>
<p><a href="index.php?controller=wishlist&action=addItem&id=$idURL">Add to my Wishlist</a></p>

EOT;
?>
