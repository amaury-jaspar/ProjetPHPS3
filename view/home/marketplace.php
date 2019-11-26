<?php

echo '<div class="container">';
echo '<h3>Greetings my friend, choose a shop and have fun shopping</h3>';

foreach ($tab_category as $categoryName => $catDescription) {

//    $catName = htmlspecialchars($category->get('name'));
//    $catDescription = htmlspecialchars($category->get('description'));

echo <<< EOT
<div class="row">
    <div class="col s12 m7">
      <div class="card medium">
        <div class="card-image">
          <img src="../images/$categoryName.jpeg">
          <span class="card-title">$categoryName</span>
        </div>
        <div class="card-content">
          <p>$catDescription</p>
        </div>
        <div class="card-action">
          <a href="index.php?action=paging&controller=item&condition=$categoryName">Enter $categoryName</a>
        </div>
      </div>
    </div>
  </div>
EOT;

}
echo '</div>';


?>