<?php

echo <<< EOT
<header>
    <nav>
    <div class="nav-wrapper">
        <a href="index.php?action=pageDeGardeBuilder&controller=accueil" class="brand-logo">Le marché de l'aventurier</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
EOT;
        if(!empty($_SESSION['login'])) { echo '<li class="green">vous êtes connecté</li>'; }
echo <<< EOT
        <li><a href="index.php?action=pageDeGardeBuilder&controller=accueil">Accueil</a></li>
                <li><a href="index.php?action=pagination&controller=produit">Catalogue</a></li>
                <li><a href="index.php?action=readBasket&controller=produit">Panier</a></li>
EOT;

if (!empty($_SESSION['login'])) {
                echo '<li><a href="index.php?action=read&controller=inventory">Inventaire</a></li>';
                echo '<li><a href="index.php?action=read&controller=wishList">Liste de souhait</a></li>';
                echo '<li><a href="index.php?action=pageBuilder&controller=utilisateur'."&login=".$_SESSION['login'].'">Profil</a></li>';
                echo '<li><a class="waves-effect waves-light btn-small" href="index.php?action=disconnect&controller=utilisateur">Se Déconnecter</a></li>';
}

if (empty($_SESSION['login'])) {
                echo '<li><a href="index.php?action=create&controller=utilisateur">S\'inscrire</a></li>';
                echo '<li><a class="waves-effect waves-light btn-small" href="index.php?action=connect&controller=utilisateur">Se connecter</a></li>';
    }
echo <<< EOT
            </ul>
        </div>
    </nav>
</header>
EOT;

?>

