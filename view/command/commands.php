<?php

// $sumBasket = htmlspecialchars($_SESSION['sumBasket']);
echo "<h1>Your orders</h1>";

$totalPrice = 0;
if (!empty($tab_commands)){
	foreach($tab_items as $item) {
		$itemName = htmlspecialchars($item->get('name'));
		$itemIdURL = rawurlencode($item->get('id'));
		$itemPriceURL = rawurlencode($item->get('price'));

		$totalPrice += $item->get('price');

		echo <<< EOT
<div style="border: 1px solid black;text-align:left;padding:1em;margin:1em;">

<h6>$itemName</h6>
<img src="../images/$itemName.png" alt="image">
<br>
<p><a href="index.php?controller=item&action=read&id=$itemIdURL">More about this item</a></p>
</div>
EOT;
	}
} else {
	echo "You haven't ordered anything";
}
echo <<< EOT
<div>
  <p>TOTAL COST : $totalPrice</p>
</div>
EOT;
?>
