<?php

foreach ($tab_item as $item) {

	$htmlID = htmlspecialchars($item->getID());
	$htmlName = htmlspecialchars($item->getName());

	echo '<p> item : <a href="index.php?controller=item&action=read&id='. $htmlID . '"> ' . $htmlName . '</a>.</p>';

}

echo '<a href="index.php?controller=item&action=create">Create a new item</a>';

?>

