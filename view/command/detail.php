<?php

$itemName = htmlspecialchars($item->get('name'));
$itemPrice = htmlspecialchars($item->get('price'));
$itemDescription = htmlspecialchars($item->get('description'));

$idURL = rawurlencode($item->get('id'));
$priceURL = rawurlencode($item->get('price'));


echo '<div>Name : '.$itemName.'</div> <div>Price : '.$itemPrice.'</div> Description '.$itemDescription.'</div>';

echo '<img class="responsive-img" width="200" height="200" src="../images/'.$itemName.'.jpg" alt="">';

echo '<br>';
?>