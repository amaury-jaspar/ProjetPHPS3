<?php

$userSurname = htmlspecialchars($user->get('surname'));
$userLogin = rawurldecode($user->get('login'));

echo "<h1>YOUR ACCOUNT</h1>";

echo "<p>Hi " . $userSurname . ", welcome</p>";

// Afficher les données personnelles
// Proposer de tout modifier, on renvoie vers un update, on sauvegarde tout et on update
// Mais attention à ne pas repasser par création

// Préférence, pour savoir ce que l'on veut en particulier sur le site

//Vos paramètres de connexion et sécurité
    // ajouter un numéro de téléphone
    // changer mot de passe, nom, prenom, login
    // Etudier le système de vérification en 2 étapes 2SV

//Votre adresse de livraisons et facturation
    // Votre adresse de livraison actuelle
    // Demande une nouvelle table avec login utilisateur, puis Numéro, rue, ville, code postal, département, pays et même numéro de téléphone
    // On doit aussi pouvoir ajouter des instructions à l'intention du livreur, avec aussi quel jours on préfère recevoir le coli

//Vos options de paiments
    // Vos cartes de paiment
        // Ajouter une carte de paiement
                // Nom du titulaire de la carte, Numéro de la carte, date d'expiration, cryptogramme visuel
                // Ajouter votre cartes

//Votre porte monnaie : Toute la gestion du porte-monnaie vers cette page
    // Votre argent
    // Réaliser un versement à votre compte
    // Réaliser un versement au compte d'un autre utilisateur
    // Ajouter des sous, faire l'aumone à l'administrateur
    // consulter le solde du porte-monnaie

    echo <<< EOT

    
    <p><a href="index.php?action=read&controller=user&login=$userLogin">Detail</a></p>
    <p><a href="index.php?action=readUserCommand&controller=command">Your commands</a></p>
    <p><a href="index.php?action=securitySetting&controller=user&login=$userLogin">Security setting and connection</a></p>
    <p><a href="index.php?action=manageWallet&controller=user&login=$userLogin">Manage your Wallet</a></p>
    <p><a href="index.php?action=&controller=user&action=update&login=$userLogin">Modify the data of your account</a></p>
    <p><a href="index.php?action=&controller=user&action=delete&login=$userLogin">Delete your account</a></p>

EOT;
?>
