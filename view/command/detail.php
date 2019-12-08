<?php

$url_commandId = rawurlencode($command->get('id_command'));

$html_commandId = htmlspecialchars($command->get('id_command'));
$html_user = htmlspecialchars($command->get('login_user'));
$html_date = htmlspecialchars($command->get('date_buy'));

echo <<< EOT
<h1>Command n°$html_commandId</h1>
<p>User : $html_user</p>
<p>Date : $html_date</p>
<div class="row">
EOT;

foreach($tab_items as $item) {
    $itemName = htmlspecialchars($item['name']);
    $itemQuantity = htmlspecialchars($item['quantity']);
    $itemIdURL = rawurlencode($item['id']);

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
                <a href="index.php?controller=item&action=read&id=$itemIdURL">Detail page</a>
            </div>
        </div>
    </div>
</div>
EOT;
}
echo '</div>';

if (Session::is_admin()) {
echo <<< EOT
<p><a href="index.php?controller=command&action=delete&id=$url_commandId">Delete this command from DataBase</a></p>
<!-- <p><a href="index.php?controller=command&action=update&id=$url_commandId">Modify this command</a></p> -->
   
EOT;
}
?>