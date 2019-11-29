<?php
session_start(); // instruction à placer avant toute écriture de code HTML
require_once ('../lib/File.php');
require_once (File::build_path(array('lib', 'Session.php')));
require_once (File::build_path(array('lib', 'viewBuilder.php')));
require_once (File::build_path(array("controller", "Routeur.php")));

?>
