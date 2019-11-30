<?php
session_start(); // instruction à placer avant toute écriture de code HTML
/*
echo 'SESSION :';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
echo 'COOKIE :';
echo '<pre>';
var_dump($_COOKIE);
echo '</pre>';
*/
require_once ('../lib/File.php');
require_once (File::build_path(array("controller", "Routeur.php")));
?>
