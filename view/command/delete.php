<?php

$id = rawurldecode($id);

echo <<< EOT
<div class="row">
    <div class="col s12 m6 center">
          <div class="card">
                <div class="card-content">
                    Do you really want to delete that command ?
                </div>
                <div class="card-action">
                      <a class="red-text" href="index.php?controller=command&action=read&id=$id">No</a>
                      <a class="blue-text" href="index.php?controller=command&action=confirmDelete&id=$id">Yes</a>
                  </div>
          </div>
    </div>
</div>
EOT;

?>