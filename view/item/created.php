<?php

	$htmlItem = htmlspecialchars($item->get('name'));

	echo '<p>The item '.$htmlItem.' has been created !</p>';

    $array = array("view", "item", "list.php");
	require (File::build_path($array));
	
?>