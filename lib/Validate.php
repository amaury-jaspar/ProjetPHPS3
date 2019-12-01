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

    public static function sendValidationMail($data) {
//        $message = __DIR__ . "http//webinfo.iutmontp.univ-montp2.fr/~simondonj/ecommerce/index.php?controller=user&action=validation&login=$data['login']&nonce=$data['nonce']";
//        $DIR = __DIR__;
        echo __DIR__;
        $DIR = "http://webinfo.iutmontp.univ-montp2.fr/~simondonj/ecommerce/public/";
//        $message2 = $DIR . "index.php?controller=user&action=validation&login=".$data'.['login']."&nonce=".$data['nonce']";
        $headers = "FROM : Mystic Market Everywhere";

//        http://webinfo.iutmontp.univ-montp2.fr/~simondonj/ecommerce/public/index.php?controller=user&action=validation&login=3333&nonce=7b4b39951a2e0e6612f8c8a2aafcaf17

        mail($data['mail'], "validation", $message, $headers);
        echo "le mail a bien été envoyé";
    }

}
?>