<?php

// La classe Validate permet d'alléger le contrôleur utilisateur afin de reprendre les méthodes
// d'inscription et de validation d'email qui sont donc propre à l'utilisateur.

    // On utilise sendValidationMail() lors de la création d'un compte utilisateur
    // On utilise validation() quand l'utilisateur clic sur le lien dans le mail

class Validate {

    public static function validation() {
        if (!is_null(ModelUser::select($_GET['login'])) && ModelUser::nonceAndId($_GET['login'], $_GET['nonce'])) {
            echo "efface le nonce";
            ModelUser::eraseNonce($_GET['login'], $_GET['nonce']);
        } else {
            echo "Mauvaise clef de validation";
        }
    }

    // à placer dans le mail :
    // index.php?controller=user&action=validation&login=1234&nonce=VALEUR_DU_NONCE_ICI       
    public static function sendValidationMail($data) {
//              $path = File::build_path(array('controller', 'ControllerUtilisateur.php'));
//              $message = 'Ce mail vous est envoyé afin de valider votre compte : <a href="'.__DIR__.'index.php?action=validation&controller=validate&login='.$data['login'].'&nonce='.$data['nonce'].'">Cliquez ici</a>';
        $message = 'Ce mail vous est envoyé afin de valider votre compte : "'.__DIR__.'index.php?controller=user&action=validation&login='.$data['login'].'&nonce='.$data['nonce'].'"';
        $headers = "FROM : Mystic Market Everywhere";
        mail($data['mail'], "validation", $message, $headers);
        echo "le mail a bien été envoyé";
        echo '<br>';
        echo $message;
        echo '<br>';
        echo $headers;
        echo '<br>';
    }

//               http://localhost:8888/PHP/DominionVente/public/index.php?action=validation&controller=utilisateur&login=5555&nonce=2daa4321c9692f6dc84a2fefe4334e91
// Mail actuel : http://localhost:8888/PHP/DominionVente/public/index.php?action=validation&controller=validate&login=4444&nonce=9fa4ab1932b878bdaadb3b0d3cd73bea        
//               http://localhost:8888/PHP/DominionVente/index.php?action=validation&controller=validate&login=5555&nonce=29a7db057fe350faebc678367fc94a37

}
?>