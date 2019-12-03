TODO :

Vérification du mail :
Dans le cas ou l'utilisateur fait une faute de frappe dans le mail, et qu'il est envoyé à quelqu'un d'autre.
le nonce est envoyé à la mauvaise addresse, et donc un autre utilisateur peut valider le mail avec le nonce.
Il faut donc demander à l'utilisateur d'être connecté pour pouvoir valider une addresse email grâce au nonce.
DONC il faut un champ email_validated dans la dession qui fait que quand on est connecté sans avoir validé, alors on ne peut que valider son email.

Comment faire un vrai chemin URL absolu :
http//{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}
A PLACER DANS VALIDATE
tenter un echo de "http//".{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}; dans index.php

Rajouter une vérification avant la suppression de quoi que ce soit. surtout item et user si ça n'est pas déjà fait.

Le mail qui doit être envoyé pour valider la création de comtpe
http://localhost:8888/PHP/ProjetPHPS3/public/index.php?controller=user&action=validation&login=test&nonce=87b48df4143301877ab74822b0cd8c4fle
http://webinfo.iutmontp.univ-montp2.fr/~simondonj/ecommerce/public/index.php?action=buildFrontPage&controller=home

LA NOTATION :

HTML/CSS :
validés et séparés (chercher s'il n'y a pas un peu de inline qui traine)
charset='utf-8' DONE
Tester le HTML et CSS sur W3C : https://validator.w3.org/
factoriser le code (include pour header, footer et content) DONE
Utilisation de div pour la mise en page
CSS responsive

FORMULAIRE :
vérification en html5
préremplissage avec placeholder
préremplissage données en php DONE

BACK-OFFICE :
Message de bienvenue
Securisation de quelques pages (manuellement), surtout les update et créate, exactement comment est protégé la vue create de user à l'heure actuelle
Sécurisation de toutes les pages (automatisé via le controleur) : peut-être qu'en fonction de l'action demandé, on peut vérifier si la personne est admin ou user etc...

SESSION :
Il faut l'information que l'on s'est identifié (is_connected ?)
Donc il faut vérifier l'état de connection très souvent, pour toutes les vues qui le nécessite.

CRUD :
Faire une fonctionnalité qui nécessite une jointure

MVC :
Aucun code HTML hors des vues
Aucun SQL hors du modèle
Aucun calcul dans les vue (les if sont des calculs, et on en a plein)


La qualité de la démonstration est noté, il faut se faire une liste des fonctionnalités que l'on veut montrer !!!!!!!!!!!!!

Pour checkPassword dans user, il faudrait utiliser ModelUser::selectWhere($data) qui fait un select sur les champs de $data (login et mpd), et non pas utilisé ModelUser::select($data)



Transfert to wish list ne fonctionne pas

Faire l’autorisation d’upload dans le tuto d’uploading d’images

Voir problèmes de sessions avec addToBasket

Faire que le disconnect renvoie vers la page home

Les vues à sécuriser les plus importantes sont du genre update ou delete car ce sont elles qui font véritablement le script, les autres ne font que construire les pages.

https://www.php.net/manual/fr/book.password.php

Prévention de hijacking :
	On peut authentifier les utilisateurs en stockant leur adresse IP, en plus d'autres détails
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	A chaque fois que l'on charge une page et qu'une session est disponible :
	on vérifie de cette manière :
	if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {   different_user();    } 
	et le code dans different_user(); est encore à déterminer (rick rolled ?)
		il est recommander de supprimer la session actuelle, et de demander à l'utilisateur de se connecter à nouveau à cause d'une erreur technique
		


test une concatenation de $_SERVER['HTTP_HOST'] et $_SERVER['REQUEST_URI']


— Vérifier les triggers
— Reprendre la grille de notation et faire le boulot demandé
	validation html/css
	sécurisation et préremplissage formulaire
	fonction mail
	si user ou admin, vérifier accès aux vues
	CRUD des controller
	model générique
	URL relatives et chemin de fichier en absolu
	échappement des variables dans les vues
	contrainte de clef étranger dans les requêtes SQL
— Finir l’enregistrement des commandes

QUESTION :
— Comment renouveler l’identifiant de la session régulièrement, dans l’action connected ?
— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique
Faut-il faire passer le basket dans lib ? ou bien le garder dans les controller alors même que Model Basket n’a aucun intérêt ?


Rajouter des limiteurs dans les setters, et vérifier l’existante d’un attribut (à l’aide d’un tableau contenant tous les nom d’attribut ? ou bien avec une méthode particulière ?)

Utiliser le panier de la session pour afficher le nombre de produit dans le panier courant et faire des ajout ou retrait

— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique
Faut-il faire passer le basket dans lib ? ou bien le garder dans les controller alors même que Model Basket n’a aucun intérêt ?

— Système de vérification que l’attribut existe quand on appelle un get dessus
— Refactoriser la vue confirmBuyBasket pour créer un système de cas d’erreur
— Vérifier le delete on cascade des categorie jusque dans les utilisateurs
— Retirer les <br> pour mettre tout dans des div
— Ou bien faire des \n quand il s’agit de chaine de caractères.
— Peut-être qu’il n’y a alors pas besoin de recopier le panier de cookie dans session au moment du confirm buy

Pour chaque fonction, se demander si :
	1 — Un utilisateur autre que l’utilisateur actuel a le droit d’y accéder
	2 — Un utilisateur non connecté a le droit d’y accéder
	3 — Un utilisateur autre que admin a le droit de s’y connecter
	4 — Si refus, on peut peut-être ne tout simplement pas rediriger automatique vers une vue
	5 — Si la requête, en Post ou en Get, n’a pas été modifié (manque un attribut requis, un attribut a été modifié et n’est plus au format valide, 

Session :
	— Est-ce que la session est bien gérer ? démarrage au début, destruction à la fin
	— S’assurer que l’on déconnecte les gens après un certain temps

Profile :
	Faire les vues de ce menu
	Y faire le système de préférence

Administration :
	Faire la vue commande dans ce menu

Command :
	Historique des commandes à terminer

Avant de finir :
	— Dans le formulaire create / update d’objets, terminer en remettant la variable $method dans le formulaire
	— Passer la valeur de Debug à False dans conf
	— Envoyer le site sur webinfo et tester le fonctionnement des chemins
	— placer le path  « /~simondonj/ecommerce/" après time et une virgule dans les setcookie afin de privatiser les cookies

Sécuriser les vues
	Pour toutes les vues et actions nécessaire :
		— Vérifier s’il faut être connecté
		— Vérifier s’il faut être user
		— Vérifier s’il faut être admin

Commenter tout le code

Ajouter plus d'item à la base de données


Si possible, terminer le QueryBuilder et l'utiliser dans Model
Rajouter des méthodes où l’on passe l’objet $pdo en paramètre pour faire un execute