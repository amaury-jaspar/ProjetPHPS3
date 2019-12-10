1 / une variable dans la SESSION qui regarde si le nonce est bien supprimé

2 / Sécurisation de vue sur ControllerItem, surtout create et update, avec is_admin, is_user, is_connected

3 / Vérification du mail :
Dans le cas ou l'utilisateur fait une faute de frappe dans le mail, et qu'il est envoyé à quelqu'un d'autre.
le nonce est envoyé à la mauvaise addresse, et donc un autre utilisateur peut valider le mail avec le nonce.
Il faut donc demander à l'utilisateur d'être connecté pour pouvoir valider une addresse email grâce au nonce.
DONC il faut un champ email_validated dans la dession qui fait que quand on est connecté sans avoir validé, alors on ne peut que valider son email.