<?php

	echo '<p>The item '. htmlspecialchars($item->get('name')).' has been created !</p>';

	require (File::build_path(array("view", "item", "list.php")));
	
?>