<?php

$url_commandId = rawurlencode($command->get('id_command'));

$html_commandId = htmlspecialchars($command->get('id_command'));
$html_user = htmlspecialchars($command->get('login_user'));
$html_date = htmlspecialchars($command->get('date_buy'));

echo <<< EOT
<p>Command n°$html_commandId</p>
<p>User : $html_user</p>
<p>Date : $html_date</p>
<p><a href="index.php?controller=command&action=delete&id=$url_commandId">Delete this command from DataBase</a></p>
<!-- <p><a href="index.php?controller=command&action=update&id=$url_commandId">Modify this command</a></p> -->
   
EOT;

?>