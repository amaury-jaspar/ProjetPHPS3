<?php

require_once (File::build_path(array('lib', 'QueryBuilder.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));
require_once (File::build_path(array('lib', 'Security.php')));
require_once (File::build_path(array('lib', 'Session.php')));
require_once (File::build_path(array('lib', 'Validate.php')));

class ControllerHome {

	protected static $object = "home";

    public static function buildFrontPage() {

        $tab_category = ModelCategory::selectAll();
        $view='marketplace';
        $pagetitle='frontpage';
        require (File::build_path(array("view", "view.php")));
    }

    public static function contact() {
        if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
        $lastName = "";
        $surname = "";
        $mail = "";
        $object = "";
        $message = "";
        $view='contact';
        $pagetitle='Form contact';
        require (File::build_path(array("view", "view.php")));
    }

    public static function post_contact() {
        $errorsMessage = [];
        if((myGet('lastName')) == NULL || myGet('lastName') == "" ) {
            $errors['nom'] = "dont forget to tell us your mail";
        }
        if(myGet('mail') == NULL || myGet('mail') == "" ) {
            $errorsMessage['mail'] = "You didnt told us about your email";
        }
        if(myGet('object') == NULL || myGet('object') == "" ) {
            $errorsMessage['message'] = "You didnt wrote anything";
        }
        if(myGet('message') == NULL || myGet('message') == "" ) {
            $errorsMessage['message'] = "You didnt wrote anything";
        }
        if (!(filter_var(myGet('mail'), FILTER_VALIDATE_EMAIL))) {
            $errorMessage = 'invalid email address format';
        }
        if(!empty($errorsMessage)) {
            Messenger::alert('Incomplete data, please try again');
            foreach($errorsMessage as $message) {
                Messenger::alert($message);
            }
            $lastName = myGet('nom');
            $surname = myGet('prenom');
            $mail = myGet('mail');
            $object = myGet('objet');
            $message = myGet('message');
            $action = "contact";
            $pagetitle='Form contact';
            require (File::build_path(array("view", "view.php")));        
        } else {
            Messenger::alert('Your mail have been send');
            $mailTo = 'jean.simondon@etu.umontpellier.fr, amaury.jaspar@etu.umontpellier.fr, mathieu.lagny@etu.umontpellier.fr';
            $headers = "FROM: ". myGet('nom') . ", " . myGet('prenom') . ", " .  myGet('mail');
            mail($mailTo, myGet('objet'), myGet('message'), $headers);       
            $action = "buildFrontPage";
            $view='marketplace';
            $pagetitle='Page de contact';
            require (File::build_path(array("view", "view.php")));
        }
    }

}

?>