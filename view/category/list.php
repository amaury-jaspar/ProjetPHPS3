<?php

foreach ($tab_category as $category) {

	$categoryNameURL = rawurldecode($category->get('name'));
	$categoryNameHTML = htmlspecialchars($category->get('name'));

	echo '<p> Category : <a href="index.php?controller=category&action=read&name='. $categoryNameURL . '"> ' . $categoryNameHTML . '</a></p>';

}

echo '<a href="index.php?controller=category&action=create">Create a new category</a>';

?>

