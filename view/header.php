<?php

echo <<< EOT
<header>
    <nav>
    <div class="nav-wrapper">
        <a href="index.php?action=pageDeGardeBuilder&controller=home" class="brand-logo">Mystic Market Everywhere</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
EOT;
        if(!empty($_SESSION['login'])) { echo '<li class="green">vous êtes connecté</li>'; }
echo <<< EOT
        <li><a href="index.php?action=pageDeGardeBuilder&controller=home">Home</a></li>
                <li><a href="index.php?action=pagination&controller=product">Catalog</a></li>
                <li><a href="index.php?action=readBasket&controller=product">Basket</a></li>
EOT;

if (!empty($_SESSION['login'])) {
                echo '<li><a href="index.php?action=read&controller=inventory">Inventory</a></li>';
                echo '<li><a href="index.php?action=read&controller=wishList">Wish List</a></li>';
                echo '<li><a href="index.php?action=pageBuilder&controller=user'."&login=".$_SESSION['login'].'">Profile</a></li>';
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

