TODO :

Transfert to wish list ne fonctionne pas

Faire l’autorisation d’upload dans le tuto d’uploading d’images

Voir problèmes de sessions avec addToBasket

Faire que le disconnect renvoie vers la page home

Les vues à sécuriser les plus importantes sont du genre update ou delete car ce sont elles qui font véritablement le script, les autres ne font que construire les pages.

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