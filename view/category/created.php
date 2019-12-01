<?php

	$htmlCategory = htmlspecialchars($category->get('name'));

	echo '<p>The category '.$htmlCategory.' has been created !</p>';

    $array = array("view", "item", "list.php");
	require (File::build_path($array));
	
?>