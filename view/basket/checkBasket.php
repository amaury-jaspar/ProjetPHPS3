<?php

echo '<div class="row">';

foreach($tab_basket as $item) {

$itemName = htmlspecialchars($item->get('name'));
$itemQuantity = $_SESSION['basket'][$item->get('id')];

echo <<< EOT
<div class="col s3 m3">
    <div class="card large">
        <div class="card-image">
            <img class="responsive-img" width="200" height="200" alt="Image of the product" src="../images/$itemName.jpg">
        </div>
        <div class="card-content">
            <div class="card-action">
                <p>$itemName</p>
                <p>quantity : $itemQuantity</p>
            </div>
        </div>
    </div>
</div>
EOT;
}

echo "</div>";

echo "<p>Your money now : " . $moneyBefore."</p>";
echo "<p>Your money after : " . $moneyAfter."</p>";
echo "<p>TOTAL COST : " . $sumBasket."</p>";

echo <<< EOT
<p>Do you really want to buy that basket ?</p>
<p><a href="index.php?controller=basket&action=readBasket">Modify my basket</a></p>
<p><a href="index.php?controller=basket&action=confirmBuyBasket">Purchase</a></p>
EOT;

?>
