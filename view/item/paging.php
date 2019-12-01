<h1>OUR CATALOG</h1>


<div class="row">
    <form method="get" action="index.php?" class="col s12">
        <div class="row" id="test">
            <div class="input-field col s12">
                    <input type='hidden' name='action' value='paging'>
                    <input type='hidden' name='controller' value='item'>
                    <select id="select" name="condition">
                        <option id="select" value="" disabled selected>Tri : All shop</option>
                        <?php
                        foreach($tab_category as $category) {
                            $tabName = htmlspecialchars($category->get('name'));
                            echo " <option value=".$tabName.">Tri : ".ucfirst($tabName)."</option>  ";
                        }
                        ?>
                    </select>
                    <input type="submit" value="Envoyer">
            </div>
        </div>
    </form>
<div>

<?php

echo '<div class="center-align">';
for ($i = 1; $i <= $nbPage; $i++) {
    echo '<a href="index.php?action=paging&controller=item&currentpage='.$i.'"> '.$i.' </a>';
}
echo '</div>';

echo '<div class="row">';
foreach($tab_result as $item) {

        // On n'affiche que les articles dont l'aventurier à le niveau pour y accéder
if (Session::is_connected() && $user->get('level') >= $item->get('levelaccess') || $item->get('levelaccess') < 1 || Session::is_admin()) {

$itemIdURL = rawurldecode($item->get('id'));
$itemIdHTML = htmlspecialchars($item->get('id'));
$itemNameHTML = htmlspecialchars($item->get('name'));

echo <<< EOT
    <div class="col s2 m2">
    <div class="card medium">
        <div class="card-image">
        <img class="responsive-img" width="100" height="100" src="../images/$itemNameHTML.jpg">
        </div>
            <div class="card-content">
            <p>$itemNameHTML</p>
            </div>
                <div class="card-action">
                <a href="index.php?controller=item&action=read&id=$itemIdURL">$itemNameHTML</a>
                </div>
        </div>
    </div>
EOT;

    }

}
echo '</div>';

echo '<div class="center-align">';
for ($i = 1; $i <= $nbPage; $i++) {
        echo '<a href="index.php?action=paging&controller=item&currentpage='.$i.'"> '.$i.' </a>';
    }
echo '</div>';
?>
