<?php

    $itemName = htmlspecialchars($item->get('name'));

echo <<< EOT
    <div class="row container">
        <div class="col s12 m6 center">
              <div class="card">
                    <div class="card-content">
                         The item $itemName has been added to the basket 
                    </div>
                    <div class="card-action">
                          <a class="blue-text" href="index.php?action=readBasket&controller=basket">See your basket ?</a>
                          <a class="red-text" href="index.php?action=paging&controller=item">Continue your buy ?</a>
                    </div>
              </div>
        </div>
    </div>
EOT;

?>