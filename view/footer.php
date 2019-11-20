<?php

echo <<< EOT
<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Mystic Market Everywhere</h5>
                <p class="grey-text text-lighten-4">Site selling equipment for adventurers</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <ul>
                  <li><a class="grey-text text-lighten-3" href="index.php?action=contact&controller=home">Contact</a></li>
EOT;
if (Session::is_admin()) {
                    echo '<li><a class="grey-text text-lighten-3" href="index.php?action=dashboard&controller=administration">Administration</a></li>';
}
echo <<< EOT
                  <li><a class="grey-text text-lighten-3" href="#!">À Propos</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Equipe</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            <p class="left">© 2019 Copyright Text</p>
            <p class="right">Par <a class="grey-text text-lighten-4" href="http://webinfo.iutmontp.univ-montp2.fr/~simondonj/">Jean Simondon</a>, <a class="grey-text text-lighten-4" href="https://amaury-jaspar.github.io/">Amaury Jaspar</a>, <a class="grey-text text-lighten-4" href="https://mathieu-lagny.github.io/">Mathieu Lagny</a></p>
            </div>
          </div>
        </footer>
EOT;
?>