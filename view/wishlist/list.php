<?php

    // $sumBasket = htmlspecialchars($_SESSION['sumBasket']);

    echo "<h1>YOUR WISHLIST</h1>";

    foreach($tab_item as $item) {

        $itemName = htmlspecialchars($item->get('name'));
        $itemQuantity = htmlspecialchars($tab_basket[$item->getId()]);
        $itemIdURL = rawurlencode($item->get('id'));
        $itemPriceURL = rawurlencode($item->get('price'));

        echo "<div style='border: 1px solid black;text-align:left;padding:1em;margin:1em;'>";

        echo "<h6>" . $itemName . "</h6>";
//        echo '<img src="../image/produit/'. $item->getName() .'.jpg" alt="">';
        echo "quantity : ". $itemQuantity;
        echo '<br>';
        echo "Transfert item from wishlist to basket: ";
        echo '<br>';
        echo '<a href="index.php?action=deleteItem&controller=wishlist&id='.$itemIdURL.'&prix='.$itemPriceURL.'">Remove from wishlist</a>';
        echo '<br>';
        echo 'Detail page of this item : <p><a href="index.php?controller=item&action=read&id='.$itemIdURL.'">'.Detail.'</a></p>';
        echo "</div>";
    }

    echo '<br>';
    echo "TOTAL COST : " . $currentWishlist;
    echo '<br>';
    echo '<br>';
    // echo '<a href="index.php?action=addAll&controller=item">Add all items to the basket</a>';
