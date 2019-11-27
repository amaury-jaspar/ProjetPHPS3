<?php

    $sumBasket = htmlspecialchars($_SESSION['sumBasket']);

    echo "<h1>YOUR BUY</h1>";

    foreach($currentBasket as $item) {

        $itemName = htmlspecialchars($item->get('name'));
        $itemQuantity = htmlspecialchars($tab_basket[$item->get('id')]);
        $itemIdURL = rawurlencode($item->get('id'));
        $itemPriceURL = rawurlencode($item->get('price'));

        echo "<div style='border: 1px solid black;text-align:left;padding:1em;margin:1em;'>";

        echo "<h6>" . $itemName . "</h6>";
        echo '<img src="../image/produit/'. $itemName .'.jpg" alt="">';
        echo "quantity : ". $itemQuantity;
        echo '<br>';
        echo "Transfert item from basket to wishlist: ";
        echo '<br>';
        echo '<a href="index.php?action=deleteFromBasket&controller=basket&id='.$itemIdURL.'&prix='.$itemPriceURL.'">Remove from basket</a>';
        echo '<br>';
        echo 'Detail page of this item : <p><a href="index.php?controller=item&action=read&id='.$itemIdURL.'">'.Detail.'</a></p>';
        echo "</div>";
    }

    echo '<br>';
    echo "TOTAL COST : " . $sumBasket;
    echo '<br>';
    echo '<br>';
    echo '<a href="index.php?action=beforeBuyBasket&controller=basket">Purchase</a>';
    echo '<br>';
    echo '<br>';    
    echo '<a href="index.php?action=resetBasket&controller=basket">Empty the basket</a>';

    // Prix du panier ici, une fois que je suis parvenu à reconstruire un tableau d'objet et non pas d'idée.

                // On affiche le contenu du panier sur la page panier
                // On affiche la somme des produits
                // Pour chaque produit, on propose de retirer l'article de la liste (deleteFromBasket)
                // On propose d'accéder à la page détaillé du produit
                // On propose d'ajouter le produit à sa liste de souhait et de le retirer du panier (mettre de côté)
                // On propose d'acheter le contenu du panier


    // Acheter pour vous
    // Faire un cadeau

?>