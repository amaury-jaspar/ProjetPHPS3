<?php

	echo "<p>The category ". htmlspecialchars($category->get('name')) ." has been created !</p>";
	
    $array = array("view", "category", "list.php");
    require (File::build_path($array));

?>