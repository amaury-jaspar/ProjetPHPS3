<?php

$sumBasket = htmlspecialchars($_SESSION['sumBasket']);

echo "<h1>YOUR BASKET</h1>";

echo '<div class="row">';

foreach($tab_basket as $item) {

    $itemName = htmlspecialchars($item->get('name'));
    $itemQuantity = htmlspecialchars($_SESSION['basket'][$item->get('id')]);
    $itemIdURL = rawurlencode($item->get('id'));
    $itemPriceURL = rawurlencode($item->get('price'));

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
                <a href="index.php?controller=item&action=transfertToWL&id=&itemIdURL">Transfert To wish list</a>
                <a href="index.php?controller=basket&action=deleteFromBasket&id=$itemIdURL">Remove one exemplary</a>
                <a href="index.php?controller=item&action=read&id=$itemIdURL">Detail page</a>
            </div>
        </div>
    </div>
</div>
EOT;

}

echo '</div>';

echo "<div><h3>Total : $sumBasket</h1></div>";

echo <<< EOT
<div class="row">
    <div class="col s12 m6 center">
          <div class="card">
                <div class="card-content">
                    Buy or empty the basket ?
                </div>
                <div class="card-action">
                      <a class="btn $ButtonState" href="index.php?action=beforeBuyBasket&controller=basket">Purchase</a>
                      <a class="btn $ButtonState" href="index.php?action=resetBasket&controller=basket">Empty The Basket</a>
                </div>
          </div>
    </div>
</div>
EOT;


?>
