<?php

$login = rawurldecode($login);

echo <<< EOT

Do you really want to delete that user ?
<br>
<br>
<a href="index.php?controller=user&action=read&login=$login">No</a>
<br>
<br>
<br>    
<a href="index.php?controller=user&action=deleted&login=$login">Yes</a>
<br>
EOT;

?>