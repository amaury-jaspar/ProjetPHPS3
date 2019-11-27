<?php

    // $sumBasket = htmlspecialchars($_SESSION['sumBasket']);
    require_once(File::build_path(array('model','ModelItem.php')));

    echo "<h1>YOUR WISHLIST</h1>";

    $totalPrice = 0;

    if (!empty($wishlist)) {
      $tab_wishes = array();
      foreach ($wishlist as $tuple) {
        $current_item = ModelItem::select($tuple['item_id']);
        $tab_wishes[] = $current_item;
      }
      foreach($tab_wishes as $item) {
        $itemName = htmlspecialchars($item->get('name'));
        $itemIdURL = rawurlencode($item->get('id'));
        $itemPriceURL = rawurlencode($item->get('price'));

        $totalPrice += $item->get('price');

echo <<< EOT
<div style="border: 1px solid black;text-align:left;padding:1em;margin:1em;">

<h6>$itemName</h6>
<img src="../images/$itemName.png" alt="image">
<br>
Transfer item from wishlist to basket:
<br>
<a href="index.php?controller=wishlist&action=removeFromWishlist&id=$itemIdURL">Remove from wishlist</a>
<br>
Detail page of this item : <p><a href="index.php?controller=item&action=read&id=$itemIdURL">Detail</a></p>
</div>
EOT;

      }
    } else {
      echo "Your wishlist is empty";
    }

    echo '<br>';
    echo "TOTAL COST : " . htmlspecialchars($totalPrice);
    echo '<br>';
    echo '<br>';
?>
