<?php

foreach ($tab_command as $command) {

  $url_commandId = rawurldecode($command->get('id_command'));
  $html_commandId = htmlspecialchars($command->get('id_command'));

  echo '<p>Command : <a href="index.php?controller=command&action=read&id='. $url_commandId . '"> ' . $html_commandId . '</a></p>';

}

echo '<p><a href="index.php?controller=command&action=create">Create a new command</a></p>';

?>

