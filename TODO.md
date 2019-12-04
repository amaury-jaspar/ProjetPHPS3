TO DO :

Utiliser un serveur qui affiche les warnings et corriger tout ça

Profile :
	Faire les vues de ce menu
	Y faire le système de préférence

Getter et Setter générique :
Rajouter des limiteurs dans les setters, et vérifier l’existante d’un attribut (à l’aide d’un tableau contenant tous les nom d’attribut ? ou bien avec une méthode particulière ?)
Système de vérification que l’attribut existe quand on appelle un get dessus

Commande :
Finir l’enregistrement des commandes
Faire un readAll dans le nav administration, sous la forme d'une table

Transfert to basket :
terminer la méthode qui ajoute l'item au panier et le supprime de Wishlist

Basket :
Refactoriser la vue confirmBuyBasket pour créer un système de cas d’erreur

Add ou remove item depuis le readbasket :
Utiliser le panier de la session pour afficher le nombre de produit dans le panier courant et faire des ajout ou retrait

Vérification du mail :
Dans le cas ou l'utilisateur fait une faute de frappe dans le mail, et qu'il est envoyé à quelqu'un d'autre.
le nonce est envoyé à la mauvaise addresse, et donc un autre utilisateur peut valider le mail avec le nonce.
Il faut donc demander à l'utilisateur d'être connecté pour pouvoir valider une addresse email grâce au nonce.
DONC il faut un champ email_validated dans la dession qui fait que quand on est connecté sans avoir validé, alors on ne peut que valider son email.

MVC :
Virer tout le code php des vues (je sais pas trop comment faire pour virer les if)

Delete item :
Voir s'il y a une sécurité au bouton delete qui demande vérification

Mise en page :
remplacer les <br> par des <div>
CSS responsive

BACK-OFFICE :
Message de bienvenue
Securisation de quelques pages (manuellement), surtout les update et créate, exactement comment est protégé la vue create de user à l'heure actuelle
Sécurisation de toutes les pages (automatisé via le controleur) : peut-être qu'en fonction de l'action demandé, on peut vérifier si la personne est admin ou user etc...

CRUD :
Faire une fonctionnalité qui nécessite une jointure
Contrainte de clef étranger dans les requêtes SQL

MVC :
Aucun code HTML hors des vues
Aucun SQL hors du modèle
Aucun calcul dans les vue (les if sont des calculs, et on en a plein)

Pour checkPassword dans user, il faudrait utiliser ModelUser::selectWhere($data) qui fait un select sur les champs de $data (login et mpd), et non pas utilisé ModelUser::select($data)

Faire l’autorisation d’upload dans le tuto d’uploading d’images

SECURISATION :
Prévention de hijacking :
	On peut authentifier les utilisateurs en stockant leur adresse IP, en plus d'autres détails
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	A chaque fois que l'on charge une page et qu'une session est disponible :
	on vérifie de cette manière :
	if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {   different_user();    } 
	et le code dans different_user(); est encore à déterminer (rick rolled ?)
		il est recommander de supprimer la session actuelle, et de demander à l'utilisateur de se connecter à nouveau à cause d'une erreur technique

Echappement des variables dans les vues à vérifier

------------------------------------------------------------------------------------------------------------------------------------------------------------

PREPARER LA PRESENTATION :

Liste des fonctionnalités dont il faut faire la démonstration et qui les présente

A LA FIN :

	— Dans le formulaire create / update d’objets, terminer en remettant la variable $method dans le formulaire
	— Passer la valeur de Debug à False dans conf
	— Envoyer le site sur webinfo et tester le fonctionnement des chemins
	— placer le path  « /~simondonj/ecommerce/" après time et une virgule dans les setcookie afin de privatiser les cookies

HTML/CSS :
validés et séparés (chercher s'il n'y a pas un peu de inline qui traine)
Tester le HTML et CSS sur W3C : https://validator.w3.org/

Si possible, terminer le QueryBuilder et l'utiliser dans Model
Rajouter des méthodes où l’on passe l’objet $pdo en paramètre pour faire un execute

------------------------------------------------------------------------------------------------------------------------------------------------------------

NOTE :

Comment faire un vrai chemin URL absolu : (a été implémenter dans lib/validate)
http//{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}
test une concatenation de $_SERVER['HTTP_HOST'] et $_SERVER['REQUEST_URI']

------------------------------------------------------------------------------------------------------------------------------------------------------------

QUESTION :
— Comment renouveler l’identifiant de la session régulièrement, dans l’action connected ?
— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique
-- Faut-il faire passer le basket dans lib ? ou bien le garder dans les controller alors même que Model Basket n’a aucun intérêt ?
— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique
Faut-il faire passer le basket dans lib ? ou bien le garder dans les controller alors même que Model Basket n’a aucun intérêt ?