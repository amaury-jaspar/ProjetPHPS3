<?php

echo '<div class="container row">';
echo '<h3>Greetings my friend, choose a shop and have fun shopping</h3>';

foreach ($tab_category as $category) {

$catName = ucfirst($category->get('name'));
$catDesc = ucfirst($category->get('description'));

echo <<< EOT
  <div class="col s6 m6">
        <div class="card medium">
          <div class="card-image">
            <img src="../images/$catName.jpeg">
            <span class="card-title">$catName</span>
          </div>
          <div class="card-content">
            <p>$catDesc</p>
          </div>
          <div class="card-action">
            <a href="index.php?action=paging&controller=item&condition=$catName">Enter</a>
        </div>
      </div>
  </div>
EOT;

}
echo '</div>';


?>