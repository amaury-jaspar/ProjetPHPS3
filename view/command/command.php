<?php

echo "<h1>Your orders</h1>";

foreach ($tab_command as $command) {

	$url_commandId = rawurldecode($command['id_command']);
	$html_commandId = htmlspecialchars($command['id_command']);
	$html_date = htmlspecialchars($command['date_buy']);

	echo '<p>Order n°<a href="index.php?controller=command&action=read&id=' . $url_commandId . '"> ' . $html_commandId . '</a> made the '.$html_date.'</p>';
}
?>