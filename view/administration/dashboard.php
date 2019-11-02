<?php

// À partir d'ici, il faut que l'administrateur, qui n'est pas un informaticien
// puisse gérer toute la vie du site web
// Gérer les produits, les utilisateurs, la base de données, etc etc..
// Il doit avoir tous les outils afin de travailler, et ce, sans toucher le code

// bloc sécurité

echo "<br>";

require_once ('dashboardNav.php');

echo "<h1>LE CONTENU COURANT DU DASHBOARD</h1>";

// Ici, trouver le moyen d'inclure le contenu d'une vue correspondant à la demande du lien
$cibleDashboard = File::build_path(array("view", $_GET['$cible'], $_GET['$view'] . ".php"));
include ($cibleDashboard);

?>