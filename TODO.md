3 / dans routeur, Il faut 2 manière supplémentaire de protéger le site web
	1: une variable dans la SESSION qui regarde si le nonce est bien supprimé
	2: un moyen de vérifier que l'adresse IP correspond bien avec celle de celui qui s'est connecté

Continuer à faire de la validaton de HTML sur w3school

4 / Sécurisation de vue sur ControllerItem, surtout create et update, avec is_admin, is_user, is_connected
	Sécurisation diverses
	Tester l'usage de l'adresse IP différente

/*
	if (Session::different_user()) {
		static::$object = "user"
		Messenger::alert("disconnected due to a technical error);
		disconnet();
	}
*/

5 / Vérification du mail :
Dans le cas ou l'utilisateur fait une faute de frappe dans le mail, et qu'il est envoyé à quelqu'un d'autre.
le nonce est envoyé à la mauvaise addresse, et donc un autre utilisateur peut valider le mail avec le nonce.
Il faut donc demander à l'utilisateur d'être connecté pour pouvoir valider une addresse email grâce au nonce.
DONC il faut un champ email_validated dans la dession qui fait que quand on est connecté sans avoir validé, alors on ne peut que valider son email.

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
