<?php

echo '<div class="container row">';
echo '<h3>Greetings my friend, choose a shop and have fun shopping</h3>';

foreach ($tab_category as $categoryName => $catDescription) {

//    $catName = htmlspecialchars($category->get('name'));
//    $catDescription = htmlspecialchars($category->get('description'));
$catName = ucfirst($categoryName);

echo <<< EOT
  <div class="col s6 m6">
        <div class="card medium">
          <div class="card-image">
            <img src="../images/$categoryName.jpeg">
            <span class="card-title">$catName</span>
          </div>
          <div class="card-content">
            <p>$catDescription</p>
          </div>
          <div class="card-action">
            <a href="index.php?action=paging&controller=item&condition=$categoryName">Enter</a>
        </div>
      </div>
  </div>
EOT;

}
echo '</div>';


?>