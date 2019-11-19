<?php

$userSurname = htmlspecialchars($user->get('surname'));
$userLogin = rawurldecode($user->get('login'));

echo "<h1>YOUR ACCOUNT</h1>";

echo "<p>Hi " . $userSurname . ", welcome</p>";


echo '<a href="index.php?action=read&controller=user&login='.$userLogin.'">Detail</a>';
echo '<br>';
echo '<br>';
// Utiliser la variable $_SERVER pour afficher des données sur l'utilisateur tel que son IP etc..

// Afficher les données personnelles
// Proposer de tout modifier, on renvoie vers un update, on sauvegarde tout et on update
// Mais attention à ne pas repasser par création
echo '<a href="index.php?action=preference&controller=user">Preference</a>';
// Préférence, pour savoir ce que l'on veut en particulier sur le site
echo '<br>';
echo '<br>';
echo '<a href="index.php?action=&controller=user">Vos commandes</a>';
echo '<br>';
echo '<br>';
echo '<a href="index.php?action=&controller=user">Paramètre de sécurité et connexion</a>';
//Vos paramètres de connexion et sécurité
    // ajouter un numéro de téléphone
    // changer mot de passe, nom, prenom, login
    // Etudier le système de vérification en 2 étapes 2SV
echo '<br>';
echo '<br>';
echo '<a href="index.php?action=&controller=user">Vos adresses</a>';
//Votre adresse de livraisons et facturation
    // Votre adresse de livraison actuelle
    // Demande une nouvelle table avec login utilisateur, puis Numéro, rue, ville, code postal, département, pays et même numéro de téléphone
    // On doit aussi pouvoir ajouter des instructions à l'intention du livreur, avec aussi quel jours on préfère recevoir le coli
echo '<br>';
echo '<br>';
echo '<a href="index.php?action=&controller=user">Option de paiements</a>';
//Vos options de paiments
    // Vos cartes de paiment
        // Ajouter une carte de paiement
                // Nom du titulaire de la carte, Numéro de la carte, date d'expiration, cryptogramme visuel
                // Ajouter votre cartes
echo '<br>';
echo '<br>';
echo '<a href="index.php?action=&controller=user">Votre porte monnaie</a>';
//Votre porte monnaie : Toute la gestion du porte-monnaie vers cette page
    // Votre argent
    // Réaliser un versement à votre compte
    // Réaliser un versement au compte d'un autre utilisateur
    // Ajouter des sous, faire l'aumone à l'administrateur
    // consulter le solde du porte-monnaie
echo '<br>';
echo '<br>';

?>
