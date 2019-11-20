<?php

echo <<< EOT
<header>
    <nav>
    <div class="nav-wrapper">
        <a href="index.php?action=buildFrontPage&controller=home" class="brand-logo">Mystic Market Everywhere</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php?action=buildFrontPage&controller=home">Marketplace</a></li>
                <li><a href="index.php?action=paging&controller=item">Catalog</a></li>
                <li><a href="index.php?action=readBasket&controller=item">Basket</a></li>
EOT;

if (!empty($_SESSION['login'])) {
                echo '<li><a href="index.php?action=read&controller=inventory">Inventory</a></li>';
                echo '<li><a href="index.php?action=read&controller=wishlist">Wish List</a></li>';
                echo '<li><a href="index.php?action=profil&controller=user'."&login=".$_SESSION['login'].'">Profile</a></li>';
                echo '<li><a class="waves-effect waves-light btn-small" href="index.php?action=disconnect&controller=user">Log out</a></li>';
}

if (empty($_SESSION['login'])) {
                echo '<li><a href="index.php?action=create&controller=user">Register</a></li>';
                echo '<li><a class="waves-effect waves-light btn-small" href="index.php?action=connect&controller=user">Login</a></li>';
    }
echo <<< EOT
            </ul>
        </div>
    </nav>
</header>
EOT;

?>
