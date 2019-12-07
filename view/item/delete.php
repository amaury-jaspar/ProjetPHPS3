<?php

$id = rawurldecode($id);

echo <<< EOT
<div class="row">
    <div class="col s12 m6 center">
          <div class="card">
                <div class="card-content">
                    Do you really want to delete that item ?
                </div>
                <div class="card-action">
                      <a class="red-text" href="index.php?controller=item&action=read&id=$id">No</a>
                      <a class="blue-text" href="index.php?controller=item&action=confirmDelete&id=$id">Yes</a>
                  </div>
          </div>
    </div>
</div>
EOT;

?>