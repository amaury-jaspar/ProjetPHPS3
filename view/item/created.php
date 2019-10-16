<?php
	$htmlImmatriculation = htmlspecialchars($immat);

	echo '<p>La voiture '.$htmlImmatriculation.' a bien été créée !</p>';
	require File::build_path(array('view','voiture','list.php'));
?>