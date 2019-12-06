<?php

    // $sumBasket = htmlspecialchars($_SESSION['sumBasket']);
echo "<h1>YOUR WISHLIST</h1>";

$totalPrice = 0;

echo '<div class="row">';

if (!empty($wishlist)){
  foreach($tab_wishes as $item) {
    $itemName = htmlspecialchars($item->get('name'));
    $itemIdURL = rawurlencode($item->get('id'));
    $itemPriceURL = rawurlencode($item->get('price'));

    $totalPrice += $item->get('price');

    
echo <<< EOT
<div class="col s3 m3">
    <div class="card large">
        <div class="card-image">
          <img class="responsive-img" width="200" height="200" src="../images/$itemName.jpg">
        </div>
        <div class="card-content">
            <div class="card-action">
                <p>$itemName</p>
                <a href="index.php?controller=item&action=addToBasket&prix=$itemPriceURL&id=$itemIdURL">Add item to basket</a>
                <a href="index.php?controller=wishlist&action=removeFromWishlist&id=$itemIdURL">Remove from wishlist</a>
                <p><a href="index.php?controller=item&action=read&id=$itemIdURL">More about this item</a></p>
            </div>
        </div>
    </div>
</div>
EOT;
  }
} else {
  echo "Your Wishlist is empty";
}
echo <<< EOT
</div>
<div>
  <p>TOTAL COST : $totalPrice</p>
</div>
EOT;
?>
