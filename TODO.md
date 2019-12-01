TODO :

voir problèmes de sessions avec addToBasket

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
	cookie et session pas possible depuis un autre site
— Finir l’enregistrement des commandes

— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique
Faut-il faire passer le basket dans lib ? ou bien le garder dans les controller alors même que Model Basket n’a aucun intérêt ?

— Système de vérification que l’attribut existe quand on appelle un get dessus
— Refactoriser la vue confirmBuyBasket pour créer un système de cas d’erreur
— Vérifier le delete on cascade des categorie jusque dans les utilisateurs
— Retirer les <br> pour mettre tout dans des div
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
	Tester $_REQUEST (à placer dans profile)

Administration :
	Faire la vue commande dans ce menu

Command :
	Historique des commandes à terminer

Avant de finir :
	— Dans le formulaire create / update d’objets, terminer en remettant la variable $method dans le formulaire
	— Passer la valeur de Debug à False dans conf
	— Envoyer le site sur webinfo et tester le fonctionnement des chemins

Sécuriser les vues
	Pour toutes les vues et actions nécessaire :
		— Vérifier s’il faut être connecté
		— Vérifier s’il faut être user
		— Vérifier s’il faut être admin

Commenter tout le code
