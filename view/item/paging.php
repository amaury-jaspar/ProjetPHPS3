<h1>OUR CATALOG</h1>

<div class="row">
    <form method="get" action="index.php?" class="col s12">
        <div class="row" id="test">
            <div class="input-field col s12">
                    <input type='hidden' name='action' value='paging'>
                    <input type='hidden' name='controller' value='item'>
                    <select id="select" name="condition">
                        <option id="select" value="" disabled selected>Got to another shop</option>
                        <option value="alchimist">Tri : Alchimist</option>
                        <option value="tavern">Tri : Tavern</option>
                        <option value="bookstore">Tri : Bookstore</option>
                        <option value="temple">Tri : Temple</option>
                        <option value="armory">Tri : Armory</option>
                    </select>
                    <input type="submit" value="Envoyer">
            </div>
        </div>
    </form>
<div>

<?php

for ($i = 1; $i <= $nbPage; $i++) {
    echo '<a href="index.php?action=paging&controller=item&currentpage='.$i.'"> '.$i.' </a>';
}

foreach($tab_result as $item) {

echo '<div >';
echo '<p><a href="index.php?controller=item&action=read&id='. rawurlencode($item->getId()) . '"> ' . htmlspecialchars($item->getName()) . '</a>.</p>';
echo '<img src="../image/produit/'. $item->getName() .'.jpg" alt="">';
echo "</div>";

}

for ($i = 1; $i <= $nbPage; $i++) {
    echo '<a href="index.php?action=paging&controller=item&currentpage='.$i.'"> '.$i.' </a>';
 }

?>


