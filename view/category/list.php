<?php

foreach ($tab_category as $category) {

	$categoryId = rawurldecode($category->get('id'));
	$categoryName = htmlspecialchars($category->get('name'));

	echo '<p> item : <a href="index.php?controller=category&action=read&id='. $categoryId . '"> ' . $categoryName . '</a>.</p>';

}

echo '<a href="index.php?controller=category&action=create">Create a new category</a>';

?>

