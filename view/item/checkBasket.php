<?php

foreach($currentBasket as $item) {
    echo "<div style='border: 1px solid black;text-align:left;padding:1em;margin:1em;'>";
    echo "<h6>" . $item->getName() . "</h6>";
//        echo '<img src="../image/produit/'. $item->getName() .'.jpg" alt="">';
    echo "quantity : ". $tab_basket[$item->getId()];
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
echo "TOTAL COST : " . $_SESSION['sumBasket'];

echo <<< EOT

<br>
Do you really want to buy that basket ?
<br>
<a href="index.php?controller=item&action=readBasket">Modificate my basket</a>
<br>
<a href="index.php?controller=item&action=confirmBuyBasket">Purchase</a>
<br>
EOT;



?>