<?php

$html_commandId = htmlspecialchars($command->get('id_command'));
$html_user = htmlspecialchars($command->get('login_user'));
$html_date = htmlspecialchars($command->get('date_buy'));

echo '<div>Command n°'.$html_commandId.'</div> <div>User : '.$html_user.'</div> Date : '.$html_date.'</div>';

?>