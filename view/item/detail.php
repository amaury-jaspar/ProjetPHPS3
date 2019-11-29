<?php

$itemName = htmlspecialchars($item->get('name'));
$itemPrice = htmlspecialchars($item->get('price'));
$itemDescription = htmlspecialchars($item->get('description'));

$idURL = rawurlencode($item->get('id'));
$priceURL = rawurlencode($item->get('price'));


echo '<div>Name : '.$itemName.'</div> <div>Price : '.$itemPrice.'</div> Description '.$itemDescription.'</div>';

echo '<img class="responsive-img" width="200" height="200" src="../images/'.$itemName.'.jpg" alt="">';

echo '<br>';

if (Session::is_admin()) {
    echo '<a href="index.php?controller=item&action=delete&id=' .$idURL . ' ">Delete this item from DataBase</a>';
    echo '<br>';
    echo '<a href="index.php?controller=item&action=update&id=' . $idURL . ' ">Modify the data of this item</a>';
    echo '<br>';
}

echo '<a href="index.php?controller=basket&action=addToBasket&prix='. $priceURL .'&id=' . $idURL . ' ">Add to basket</a>';
echo "<br>";
echo "<br>";
echo '<a href="index.php?controller=wishlist&action=addItem&id=' . $idURL . ' ">Add to my Wishlist</a>';

?>
