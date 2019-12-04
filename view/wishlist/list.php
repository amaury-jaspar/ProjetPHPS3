<?php

    // $sumBasket = htmlspecialchars($_SESSION['sumBasket']);
echo "<h1>YOUR WISHLIST</h1>";

$totalPrice = 0;
if (!empty($wishlist)){
  foreach($tab_wishes as $item) {
    $itemName = htmlspecialchars($item->get('name'));
    $itemIdURL = rawurlencode($item->get('id'));
    $itemPriceURL = rawurlencode($item->get('price'));

    $totalPrice += $item->get('price');

echo <<< EOT
<div style="border: 1px solid black;text-align:left;padding:1em;margin:1em;">

<h6>$itemName</h6>
<img src="../images/$itemName.jpg" alt="image">
<br>
<a href="index.php?controller=item&action=addToBasket&prix=$itemPriceURL&id=$itemIdURL">Add item to basket</a>
<br>
<a href="index.php?controller=wishlist&action=removeFromWishlist&id=$itemIdURL">Remove from wishlist</a>
<br>
<p><a href="index.php?controller=item&action=read&id=$itemIdURL">More about this item</a></p>
</div>
EOT;
  }
} else {
  echo "Your Wishlist is empty";
}
echo <<< EOT
<div>
  <p>TOTAL COST : $totalPrice</p>
</div>
EOT;
?>
