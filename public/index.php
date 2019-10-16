<?php
session_start();

if(isset($_COOKIE['panier'])) {
    $_SESSION['panier'] = $_COOKIE['panier'];
}

require_once ('../lib/File.php');

require_once (File::build_path(array("controller", "Routeur.php")));

echo '1';
?>
