<?php

$sumBasket = htmlspecialchars($_SESSION['sumBasket']);

echo '<div class="row">';

foreach($currentBasket as $item) {

$itemName = htmlspecialchars($item->get('name'));
$itemQuantity = htmlspecialchars($tab_basket[$item->get('id')]);

echo <<< EOT
<div class="col s3 m3">
    <div class="card large">
        <div class="card-image">
            <img class="responsive-img" width="200" height="200" src="../images/$itemName.jpg">
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

echo "<div>Your money now : " . $moneyBefore."</div>";
echo "<div>Your money after : " . $moneyAfter."</div>";
echo "<div>TOTAL COST : " . $sumBasket."</div>";

echo <<< EOT
<div>Do you really want to buy that basket ?</div>
<div><a href="index.php?controller=basket&action=readBasket">Modify my basket</a></div>
<div><a href="index.php?controller=basket&action=confirmBuyBasket">Purchase</a></div>
EOT;

?>
