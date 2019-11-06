<?php

$htmlname = htmlspecialchars($item->getName());
$htmlPrice = htmlspecialchars($item->getPrice());
$htmlDescription = htmlspecialchars($item->getDescription());

 $urlID = rawurlencode($item->getID());

echo '<div>Name : '.$htmlname.'</div> <div>Price : '.$htmlPrice.'</div> Description '.$htmlDescription.'</div>';




?>