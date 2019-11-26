<?php

class Validate {

    public static function validation() {
        if (!is_null(ModelUser::select(Routeur::myGet('login'))) && ModelUser::nonceAndId(Routeur::myGet('login'), Routeur::myGet('nonce'))) {
            echo "efface le nonce";
            ModelUser::eraseNonce(Routeur::myGet('login'), Routeur::myGet('nonce'));
        } else {
            echo "Mauvaise clef de validation";
        }
    }

//    https://webinfo.iutmontp.univ-montp2.fr/my/

    public static function sendValidationMail($data) {
        $message = 'Ce mail vous est envoyé afin de valider votre compte : "'.__DIR__.'/index.php?controller=user&action=validation&login='.$data['login'].'&nonce='.$data['nonce'].'"';
        $headers = "FROM : Mystic Market Everywhere";
        echo $_SERVER['DOCUMENT_ROOT'];
        echo '<br>';
        echo $message;
        echo '<br>';
        echo $headers;
        mail($data['mail'], "validation", $message, $headers);
        echo "le mail a bien été envoyé";
    }

}
?>