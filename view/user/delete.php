<?php

$login = rawurldecode($login);

echo <<< EOT
<div class="row">
    <div class="col s12 m6 center">
          <div class="card">
                <div class="card-content">
                    Do you really want to delete that user ?
                </div>
                <div class="card-action">
                      <a class="red-text" href="index.php?controller=user&action=read&login=$login">No</a>
                      <a class="blue-text" href="index.php?controller=user&action=deleted&login=$login">Yes</a>
                </div>
          </div>
    </div>
</div>
EOT;

?>