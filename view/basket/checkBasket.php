<?php

$sumBasket = htmlspecialchars($_SESSION['sumBasket']);

foreach($currentBasket as $item) {

    $itemName = htmlspecialchars($item->get('name'));
    $itemQuantity = htmlspecialchars($tab_basket[$item->get('id')]);

    echo "<div style='border: 1px solid black;text-align:left;padding:1em;margin:1em;'>";
    echo "<h6>" . $itemName . "</h6>";
//        echo '<img src="../image/produit/'. $item->get('name') .'.jpg" alt="">';
    echo "quantity : ". $itemQuantity;
    echo '<br>';
    echo "Transfert item from basket to wishlist: ";
    echo '<br>';
    echo "</div>";
}

echo "Your money now : " . $moneyBefore;
echo "<br>";
echo "<br>";
echo "<br>";
echo "Your money after : " . $moneyAfter;
echo "<br>";
echo "<br>";
echo "TOTAL COST : " . $sumBasket;

echo <<< EOT

<br>
Do you really want to buy that basket ?
<br>
<a href="index.php?controller=basket&action=readBasket">Modify my basket</a>
<br>
<a href="index.php?controller=basket&action=confirmBuyBasket">Purchase</a>
<br>
EOT;



?>
