TO DO :

1 / Utiliser un serveur qui affiche les warnings et corriger tout ça
2 / Commande :
	- Finir l’enregistrement des commandes
	- Faire un readAll dans le nav administration, sous la forme d'une table
	- Faire une fonctionnalité qui nécessite une jointure
	- Contrainte de clef étranger dans les requêtes SQL

3 / terminer la méthode qui ajoute l'item au panier et le supprime de Wishlist

4 / Sécurisation de vue sur ControllerItem, surtout create et update






5 / Vérification du mail :
Dans le cas ou l'utilisateur fait une faute de frappe dans le mail, et qu'il est envoyé à quelqu'un d'autre.
le nonce est envoyé à la mauvaise addresse, et donc un autre utilisateur peut valider le mail avec le nonce.
Il faut donc demander à l'utilisateur d'être connecté pour pouvoir valider une addresse email grâce au nonce.
DONC il faut un champ email_validated dans la dession qui fait que quand on est connecté sans avoir validé, alors on ne peut que valider son email.


12 /
CRUD :


14 /
Pour checkPassword dans user, il faudrait utiliser ModelUser::selectWhere($data) qui fait un select sur les champs de $data (login et mpd), et non pas utilisé ModelUser::select($data)

15 /
Faire l’autorisation d’upload dans le tuto d’uploading d’images

16 /
SECURISATION :
Prévention de hijacking :
	On peut authentifier les utilisateurs en stockant leur adresse IP, en plus d'autres détails
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	A chaque fois que l'on charge une page et qu'une session est disponible :
	on vérifie de cette manière :
	if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {   different_user();    } 
	et le code dans different_user(); est encore à déterminer (rick rolled ?)
		il est recommander de supprimer la session actuelle, et de demander à l'utilisateur de se connecter à nouveau à cause d'une erreur technique

-------------------------------------------------------------------------------------------------------------------

PREPARER LA PRESENTATION :

Liste des fonctionnalités dont il faut faire la démonstration et qui les présente

A LA FIN :

	- Echappement des variables dans les vues à vérifier
	— Dans le formulaire create / update d’objets, terminer en remettant la variable $method dans le formulaire
	— Passer la valeur de Debug à False dans conf
	— Envoyer le site sur webinfo et tester le fonctionnement des chemins
	— placer le path  « /~simondonj/ecommerce/" après time et une virgule dans les setcookie afin de privatiser les cookies

HTML/CSS :
validés et séparés (chercher s'il n'y a pas un peu de inline qui traine)
Tester le HTML et CSS sur W3C : https://validator.w3.org/

Si possible, terminer le QueryBuilder et l'utiliser dans Model
Rajouter des méthodes où l’on passe l’objet $pdo en paramètre pour faire un execute

-----------------------------------------------------------------------------------------------------------------------

QUESTION :

— Comment renouveler l’identifiant de la session régulièrement, dans l’action connected ?

— Regarder pourquoi les comptes partage les cookies, donc partage les mêmes panier, quand on passe d’un compte à l’autre, on partage le même panier, c’est problématique