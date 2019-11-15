<?php

    echo "<h1>YOUR BUY</h1>";

    foreach($currentBasket as $item) {

        echo "<div style='border: 1px solid black;text-align:left;padding:1em;margin:1em;'>";
        echo "<h6>" . $item->getName() . "</h6>";
//        echo '<img src="../image/produit/'. $item->getName() .'.jpg" alt="">';
        echo "quantity : ". $tab_basket[$item->getId()];
        echo '<br>';
        echo "Transfert item from basket to wishlist: ";
        echo '<br>';
        echo '<a href="index.php?action=deleteFromBasket&controller=item&id='.rawurlencode($item->getId()).'&prix='.rawurlencode($item->getPrice()).'">Remove from basket</a>';
        echo '<br>';
        echo "Detail page of this item : ";
        echo '<p> <a href="index.php?controller=item&action=read&id='. rawurlencode($item->getId()) . '"> ' . Detail . '</a></p>';
        echo "</div>";
    }

    echo '<br>';
    echo "TOTAL COST : " . $_SESSION['sumBasket'];
    echo '<br>';
    echo '<br>';
    echo '<a href="index.php?action=beforeBuyBasket&controller=item">Purchase</a>';
    echo '<br>';
    echo '<br>';    
    echo '<a href="index.php?action=resetBasket&controller=item">Empty the basket</a>';

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