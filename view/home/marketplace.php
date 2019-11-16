<?php

echo '<h5>Greetings my friend, choose a shop and have fun shopping</h5>';

foreach ($tab_category as $cat => $catname) {

echo <<< EOT
<div class="row">
    <div class="col s12 m7">
      <div class="card medium">
        <div class="card-image">
          <img src="../images/picture.jpeg">
          <span class="card-title">$catname</span>
        </div>
        <div class="card-content">
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
          <a href="index.php?action=paging&controller=item&condition=$cat">Enter $cat</a>
        </div>
      </div>
    </div>
  </div>
EOT;

}



?>