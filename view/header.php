<?php

echo <<< EOT
<header>
    <nav class="nav-extended">
        <div class="nav-wrapper">
            <a href="index.php?action=buildFrontPage&controller=home" data-target="slide-out" class="brand-logo sidenav-trigger">Mystic Market Everywhere</a>
            <a href="#" data-target="slide-out" class="left sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="index.php?action=buildFrontPage&controller=home" data-target="slide-out" class="brand-logo hide-on-med-and-down">Mystic Market Everywhere</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php?action=buildFrontPage&controller=home">Marketplace</a></li>
                <li><a href="index.php?action=paging&controller=item">Catalog</a></li>
                <li><a href="index.php?action=readBasket&controller=basket">Basket</a></li>
EOT;
if (!empty($_SESSION['login'])) {
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
EOT;
if (Session::is_admin()) {
echo <<< EOT
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
            <a data-target="slide-out" class="brand-logo sidenav-trigger">Admin panel</a>
                <li class="tab"><a href="index.php?controller=item&action=readAll">Items management</a></li>
                <li class="tab"><a href="index.php?action=readAll&controller=user">Users Management</a></li>
                <li class="tab"><a href="index.php?action=readAll&controller=category">Categories Management</a></li>
                <li class="tab"><a href="index.php?action=readAll&controller=command">Sells management</a></li>
                <li class="tab"><a href="index.php?action=  &controller=  ">Fréquentation</a></li>
                <!-- <li class="tab"><a href="index.php?action=&controller=">Gestion des données</a></li> -->
            </ul>
        </div>
EOT;
}

/*
 * Menu déroulant pour le responsive, pour plus tard
    <ul id="slide-out" class="sidenav container">
                <a href="index.php?action=buildFrontPage&controller=home" data-target="slide-out" class="brand-logo sidenav-trigger">Mystic Market Everywhere</a>
            <a href="index.php?action=buildFrontPage&controller=home" data-target="slide-out" class="brand-logo hide-on-med-and-down">Mystic Market Everywhere</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
EOT;
if (Session::is_admin()) {
                    echo '<li><a class="grey-text text-lighten-3" href="index.php?action=dashboard&controller=administration">Administration</a></li>';
}
echo <<< EOT
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
*/
echo <<< EOT
    </nav>
</header>
EOT;
?>
