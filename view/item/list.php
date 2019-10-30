<?php
foreach ($tab_item as $item) {
	$htmlID = htmlspecialchars($item->getID());
	$htmlName = htmlspecialchars($item->getName());
	
	$urlID = rawurlencode($v->getID());

	echo '<div><a href=http://localhost/ProjetPHPS3/index.php?action=read&id='.$urlID.'>'.$htmlID.' '.$htmlName.'</a></div>';
}
?>